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
	$method = array_key_exists("HTTP_x_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//stores the Primary Key for the GET, DELETE, and PUT methods in $id. This key will come in the URL sent by the front end. If no key is present, $id will remain empty. Note that the input is filtered.
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//make sure the is is valid for the methods that require it
	if(($method === "GET" || $method === "POST") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
		//set XSRF cookie
		setXsrfCookie("/");
		// handle GET request - if id is present, that share is present, that share is returned, otherwise all share are returned

		// Here, we determine if a Key was sent in the URL by checking $id. If so, we pull the requested Share by Share ID from the DataBase and store it in $share.
		if(empty($id) === false) {
			$share = Share::getShareByShareId($pdo, $id);
			if($share !== null) {
				$reply->data = $share;
				// Here, we store the retrieved Share in the $reply->data state variable.
			}
		}
		// If there is nothing in $id, and it is a GET request, then we simply return all criteria. We store all the
	} else if($method === "POST") {
// this line determines if the request is a POST request


		//get a specific shareId or all shareIds and update NNN
		if(empty($id) === false) {
			$shareId = shareId::getShareByShareId($pdo, $id);
			if($shareId !== null) {
				$id->data = $shareId;
			}
		} else if(empty($id) === false) {
			$shareId = ShareId::getShareIdByFieldId($pdo, $fieldId);
			if($shareId !== null) {
				$reply->data = $shareId;
			}
		} else if(empty($id) === false) {
			$shareId = ShareId::getShareIdByShareUrl($pdo, $id);
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







