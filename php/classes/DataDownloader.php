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
            $findETag = array_search("ETag", $explodeETag);
            if($findETag !== false) {
                $eTag = $explodeETag[1];
            }
        }

        if($eTag === null) {
            throw(new \RuntimeException("etag cannot be found", 404));
        }

        $config = readConfig("/etc/apache2/capstone-mysql/abq-vast.ini");
        $eTag = xmlstr($config["etags"]);
        $previousETag = $eTag->$metaData;
        if($previousETag < $eTag) {
            return ($eTag);
        } else {
            return($previousETag);
        }

   }
    public static function BasicSimpleXML() {
        $xmlstr = <<<XML
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
XML;


        $dataset = new \SimpleXMLElement($xmlstr);
        foreach($dataset->data->row as $row) {
            $checkbookVendor = (string)$row->value[0];
            $referenceNumber = (string)$row->value[1];
            $invoiceNumber = (string)$row->value[2];
            $invoiceDate = (string)$row->value[3]->format("Y-m-d");
            $paymentDate = (string)$row->value[4]->format("Y-m-d");
            $invoiceAmount = (string)$row->value[5];


            var_dump ($checkbookVendor, $referenceNumber, $invoiceNumber, $invoiceDate, $paymentDate, $invoiceAmount);

        }
    }
}
DataDownloader::getMetaData("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml","checkbook");
