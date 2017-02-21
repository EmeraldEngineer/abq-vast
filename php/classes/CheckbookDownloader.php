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
    include 'DataDownloader.php';
    $checkbook = new \SimpleXMLElement($xmlstr);
    ?>




}

\DataDownloader::getMetaData("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml");