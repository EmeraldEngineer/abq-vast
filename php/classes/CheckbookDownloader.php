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
class CheckbookDownloader extends \DataDownloader {
/**
 *
 * http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml
 **/

/*readDataDownloader($url) {

}*/

}

\DataDownloader::readMetaData("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml");