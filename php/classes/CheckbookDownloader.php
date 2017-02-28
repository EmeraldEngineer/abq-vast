<?php
namespace Edu\Cnm\AbqVast;

require_once("autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

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

        $features = null;
        try {
            DataDownloader::getMetaData($checkbookUrl, "checkbook");
            $features = DataDownloader::readBasicSimpleXML($checkbookUrl);
            $checkbookETag = DataDownloader::getMetaData($checkbookUrl, "checkbook");
            $config = readConfig("/etc/apache2/capstone-mysql/abqvast.ini");
            $eTag = XMLSimpleElement($config["etag"]);
            $eTag->checkbook = $checkbookETag;
            $config["etag"] = xmlstr($eTag);
            writeConfig($config, "/etc/apache2/capstone-mysql/abqvast.ini");
        } catch(\OutOfBoundsException $outOfBoundsException) {
            echo("no new vendor data found");
        }
        return($features); 
    }
}
