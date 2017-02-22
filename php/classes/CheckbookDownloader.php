<?php
namespace Edu\Cnm\AbqVast;

require_once("autoload.php");

/**
 *
 * This class will download checkbook vendor data from the City of Albuquerque DataBase.
 *
 * @author Valente Meza vmeza3@cnm.edu
 *
 **/
/**
 * @var $previousETag
 */
class CheckbookDownloader extends DataDownloader {
    public static function compareAndDownload() {
        $checkbookUrl = "http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml";
        $eTag = DataDownloader::getMetaData($checkbookUrl, "checkbook");
        if($previousETag < $eTag) {
            $meta = self::BasicSimpleXML($checkbookUrl);
            $config = writeConfig("/etc/apache2/capstone-mysql/abq-vast.ini");
            $previousETag = BasicSimpleXML($config["eTag"]);
            return($previousETag);
        }
        return($meta);
    }

    public static function BasicSimpleXML($xmlstr)
    {
        parent::BasicSimpleXML($xmlstr);
        include 'CheckbookDownloader.php';
        $checkbook = new \SimpleXMLElement($xmlstr);
        foreach ($checkbook->vendorname->invoiceamount->invoiceamount as $invoiceamount) {}
    }
}

\DataDownloader::getMetaData("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml");