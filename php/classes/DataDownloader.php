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
        var_dump($metaData);
        $previousETag = $eTags->checkbook;
        if($previousETag < $eTag) {
            return ($eTags);
        } else {
            throw(new \OutOfBoundsException("Same Etag"));
        }

   }
    public static function readBasicSimpleXML($url) {
/*        $xmlstr = <<<XML
<?xml version='1.0' standalone='yes' ?>
<dataset>
    <data>
            <row>
                <value>1 ST HEALTH INC</value>
                <value>2606945</value>
                <value>NMSM110413VG</value>
                <value>2013-11-04T00:00:00</value>
                <value>2014-01-10T00:00:00</value>
                <value>95.05</value>
            </row>
            <row>
                <value>1 ST HEALTH INC</value>
                <value>2621206</value>
                <value>COA1361638</value>
                <value>2014-01-25T00:00:00</value>
                <value>2014-07-24T00:00:00</value>
                <value>205.55</value>
            </row>
    </data>
</dataset>
XML;*/
    $context = stream_context_create(["http" => true, "method" => "GET"]);
    try {
        if(($xmlCheckbook = file_get_contents($url, null, $context)) === false) {
            throw(new \RuntimeException("cannot connect to city server"));
        }

        $xmlDataset = json_decode($xmlCheckbook);

        $xmlDataset = $xmlDataset->dataset;

        $dataset = simplexml_load_string($xmlDataset);

    } catch(\Exception $exception) {
        throw(new \PDOException($exception->getMessage(), 0, $exception));
    }
    return($dataset);
    }

        public static function getCheckbookData(\SimpleXMLElement $pdo) {
                $pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/abqvast.ini");
                DataDownloader::readBasicSimpleXML($pdo);


        $dataset = new \SimpleXMLElement($pdo);
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
    public static function compareAndDownload($pdo) {

        $checkbookUrl = "http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml";

        $dataset = null;
        try {
            DataDownloader::getMetaData($checkbookUrl, "checkbook");
            $dataset = DataDownloader::readBasicSimpleXML($pdo);
            $checkbookETag = DataDownloader::getMetaData($checkbookUrl, "checkbook");
            $config = readConfig("/etc/apache2/capstone-mysql/abqvast.ini");
            $eTag = json_decode($config["etag"]);
            $eTag->checkbook = $checkbookETag;
            $config["etag"] = json_encode($eTag);
            writeConfig($config, "/etc/apache2/capstone-mysql/abqvast.ini");
        } catch(\OutOfBoundsException $outOfBoundsException) {
            echo("no new vendor data found");
        }
        return($dataset);
    }
}
DataDownloader::getMetaData("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml","checkbook");
/*try {
    $pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/abqvast.ini");
    DataDownloader::BasicSimpleXML($pdo);
} catch (\Exception $exception) {

}*/