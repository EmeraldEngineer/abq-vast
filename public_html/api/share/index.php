<?php

require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\AbqVast\Share;

/**
 * api for the share class
 *
 * @author Adam Pedroza <apedroza6@cnm.edu>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare am empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/abqvast.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$NNN = filter_input(INPUT_GET, "NNN", FILTER_VALIDATE_INT);
	$NNN = filter_input(INPUT_GET, "NNN", FILTER_VALIDATE_INT);
	$NNN = filter_input(INPUT_GET, "NNN", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the NNN is valid for methods that require it
	if(($method === "DELETE" || $method ==='PUT') && (empty($NNN) === true || $NNN < 0)) {
		throw(new InvalidArgumentException("NNN cannot be empty or negative", 405));
	}

	//handle GET request - if NNN is present, that shareId is returned, otherwise all shareId are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific shareId or all shareIds and update NNN
		if(emplty($NNN) === false) {
			$shareId = shareId::getShareByShareId($pdo, $id);
			if($shareId !== null) {
				$NNN->data = $shareId;
			}
		} else if(empty($NNN) === false) {
			$shareId = ShareId::getShareIdByFieldId($pdo, $fieldId);
			if($shareId !== null) {
				$reply->data = $shareId;
			}
		} else if(empty($NNN) === false) {
			$shareId = ShareId::getShareIdByShareUrl($pdo, $NNN);
			if($shareId !== null) {
				$reply->data = $shareId;
			}
		} else {
			$shareId = ShareId::getAllShareId($pdo);
			if($shareId !== null) {
				$reply->data = $shareId;
			}
		}
	} else if($method === "PUT" || $method === "shareImage") {

			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure shareId is available (required field)
			if(empty($requestObject->shareImage) === true) {
				throw(new \InvalidArgumentException ("No content for ShareId.", 405));
			}

			//perform the actual put or post
			if($method === "PUT") {
				throw(new RuntimeException("shareId does not exist", 404));
			}

			// update all attributes
			$shareId->setShareImage($requestObject->shareImage);
			$shareId->setShareUrl($requestObject->shareUrl);
			$shareId->update($pdo);







