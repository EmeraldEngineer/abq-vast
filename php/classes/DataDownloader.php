<?php
namespace Edu\Cnm\AbqVast;

require_once("autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * this Class will download data from the City of Albuquerque City Database.
 *
 * @author Valente Meza vmeza3@cnm.edu
 **/
class DataDownloader {

    /**
     * Vendor checkbook: http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml
     */
    /**
     * Gets the metadata from a file url
     *
     * @param string %url to grab from
     * @param string $eTag to be compared to previous etag to determine last download
     * @return string $eTag to be compared to previous etag to determine last download
     * @throws \RuntimeException if file doesn't exist
     **/

    public static function getMetaData(string $url, string $eTag) {
        if($eTag !== "checkbook") {
            throw(new \RuntimeException("not a valid etag, 400"));
        }
        $options = [];
        $options["http"] = [];
        $options["http"] ["method"] = "HEAD";
        $context = stream_context_create($options);
        // "@" suppresses warnings and errors, fopen opens the actual file
        $fd = fopen($url, "rb", false, $context);
        $metaData = stream_get_meta_data($fd);
        if($fd === false) {
            throw(new \RuntimeException("unable to open HTTP stream"));
        }
        fclose($fd);
        $header = $metaData["wrapper_data"];
        foreach($header as $value) {
            $explodeETag = explode(": ", $value);
            $findETag = array_search("Last-Modified", $explodeETag);
            if($findETag !== false) {
                $eTag = \DateTime::createFromFormat("D, d M Y H:i:s T", $explodeETag[1])->getTimestamp();
            }
        }

        if($eTag === null) {
            throw(new \RuntimeException("etag cannot be found", 404));
        }

        $config = readConfig("/etc/apache2/capstone-mysql/abqvast.ini");
        $eTags = json_decode($config["etags"]);
        $previousETag = $eTags->checkbook;
        if($previousETag < $eTag) {
            return ($eTag);
        } else {
            throw(new \OutOfBoundsException("Same Etag"));
        }

    }
    public static function getCheckbookXML($url) {
        $context = stream_context_create(["http" => ["method" => "GET"]]);
        try {
            if(($xmlCheckbook = file_get_contents($url, null, $context)) === false) {
                throw(new \RuntimeException("cannot connect to city server"));
            }
            $dataset = simplexml_load_string($xmlCheckbook);
        } catch(\Exception $exception) {
            throw(new \PDOException($exception->getMessage(), 0, $exception));
        }
        return($dataset);
    }

    public static function insertCheckbooksToMySql(\PDO $pdo, \SimpleXMLElement $dataset) {
        foreach($dataset->data->row as $row) {
            $checkbookVendor = (string)$row->value[0];
            $checkbookReferenceNum = (string)$row->value[1];
            $checkbookInvoiceNum = (string)$row->value[2];
            $checkbookInvoiceDate = (string)$row->value[3];
            $checkbookPaymentDate = (string)$row->value[4];
            $checkbookInvoiceAmount = (string)$row->value[5];


            $checkbookInvoiceDate = new \DateTime($checkbookInvoiceDate, new \DateTimeZone("UTC"));

            $checkbookPaymentDate = new \DateTime($checkbookPaymentDate, new \DateTimeZone("UTC"));

            $xmlCheckbook = new Checkbook(null, $checkbookInvoiceAmount, $checkbookInvoiceDate, $checkbookInvoiceNum, $checkbookPaymentDate, $checkbookReferenceNum, $checkbookVendor);
            $xmlCheckbook->insert($pdo);


        }
    }
    public static function compareAndDownload() {

        $checkbookUrl = "http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml";

        $dataset = null;
        try {
            DataDownloader::getMetaData($checkbookUrl, "checkbook");
            $dataset = DataDownloader::getCheckbookXML($checkbookUrl);
            $pdo =  connectToEncryptedMySQL("/etc/apache2/capstone-mysql/abqvast.ini");
            DataDownloader::insertCheckbooksToMySql($pdo, $dataset);
            $checkbookETag = DataDownloader::getMetaData($checkbookUrl, "checkbook");
            $config = readConfig("/etc/apache2/capstone-mysql/abqvast.ini");
            $eTag = json_decode($config["etag"]);
            $eTag->checkbook = $checkbookETag;
            $config["etag"] = json_encode($eTag);
            writeConfig($config, "/etc/apache2/capstone-mysql/abqvast.ini");
        } catch(\OutOfBoundsException $outOfBoundsException) {
            echo("no new vendor data found");
        }
    }
}
//DataDownloader::getMetaData("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml","checkbook");
try {
    DataDownloader::compareAndDownload("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml","checkbook");
} catch (\Exception $exception) {
    echo "Emerald Engineer Error (EEE): " . $exception->getMessage() . PHP_EOL;
}