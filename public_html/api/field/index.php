<?php

require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\AbqVast\Field;

/**
 * api for the field class
 *
 * @author Sarah Ruth Finkel <srfinkel@gmail.com>
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

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	// handle GET request - if id is present, that field is present, that field is returned, otherwise all fields are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		// Here, we determine if a Key was sent in the URL by checking $id. If so, we pull the requested Field by Field ID from the DataBase and store it in $field.
		if(empty($id) === false) {
			$field = Field::getFieldByFieldId($pdo, $id);
			if($field !== null) {
				$reply->data = $field;
				//here we store the received field value in the $reply-data state varible
			}
		} else {
			$field = Field::getAllFields($pdo);
			if($field !== null) {
				$reply->data = $field;
			}
		}

		// If there is nothing in $id, and it is a GET request, then we simply return all field. We store all the field in the $field variable, and then store them in the $reply->data state variable.

	} else {
		throw (new InvalidArgumentException("Invalid HTTP Method Request"));
		// If the method request is not GET, or POST, an exception is thrown
	}

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);