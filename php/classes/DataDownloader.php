<?php

require_once("autoload.php");

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
     * @return mixed stream data
     * @throws Exception if file doesn't exist
     **/

    public static function getMetaData($url) {
        $options = [];
        $options["http"] = [];
        $options["http"] ["method"] = "HEAD";
        $context = stream_context_create($options);

        //"@" suppresses warning and errors
        $fd = fopen($url, "rb", false, $context);
        $metaData = stream_get_meta_data($fd);
        if($fd === false) {
            throw(new \RuntimeException("unable to opent HTTP stream"));
        }
        fclose($fd);
        $wrapperData = $metaData["wrapper_data"];
        $http = "";
        foreach($wrapperData as $data) {
            if(strpos($data, "HTTP") !== false) {
                $http = $data;
                break;
            }
        }

        if(strpos($http, "400")) {
            throw(new Exception("Bad request"));
        }
        if(strpos($http, "401")) {
            throw(new Exception("Unauthorized"));
        }
        if(strpos($http, "403")) {
            throw(new Exception("Forbidden"));
        }
        if(strpos($http, "404")) {
            throw(new Exception("Not found"));
        }
        if(strpos($http, "418")) {
            throw(new Exception("Set to water to boil"));
        }
        return $metaData;
    }
}