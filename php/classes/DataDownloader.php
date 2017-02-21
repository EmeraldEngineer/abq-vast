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
		var_dump($eTag);
		return ($eTag);
	}
}

$meta = DataDownloader::getMetadata("http://data.cabq.gov/government/vendorcheckbook/VendorCheckBookCABQ-en-us.xml");