<?php

require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\AbqVast\Checkbook;

/**
 * api for checkbook class
 *
 * @author Taylor McCarthy <oresshi@gmail.com>
 **/

// check the session status, if it is not active, start the session.
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
//create stdClass named $reply. this object will be used to store the results of the call to the api. sets status to 200 (success). creates data state variable, holds the result of the api call.

try {
	//grab the mySQL database connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/abqvast.ini");

	//determines which HTTP Method needs to be processed and stores the result in $method
	$method = array_key_exists("HTTP_x_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//stores the Primary key for the GET methods in $id, This key will come in the URL sent by the front end. If no key is present $id will remain empty. Note that the input filtered.
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	/** Shouldn't be needed due to checkbook only requiring get and get all.
	 * //here we check and make sure that we have the Primary key for the DELETE and PUT requests. If the request is a PUT or DELETE and no key is present in $id an exception is thrown
	 * if(($method === "DELETE" || $method === "PUT" || $method === "POST") && (empty($id) === true || $id < 0)) {
	 * throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	 * }
	 **/


//here we determine if the request received is a GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");
		//handle GET request - if id is present, that checkbook value is present, that checkbook value is returned, otherwise all values are returned.

		//determine is a Key was sent in the URL by checking $id. if so we pull the requested checkbook value by checkbook ID from the database and store it in $checkbook
		if(empty($id) === false) {
			$checkbook = Checkbook::getCheckbookByCheckbookId($pdo, $id);
			if($checkbook !== null) {
				$reply->data = $checkbook;
				//here we store the received checkbook value in the $reply-data state variable
			}
		} else {
			$checkbook = Checkbook::getCheckbookByCheckbookAmount($pdo);
			if($checkbook !== null) {
				$reply->data = $checkbook;
			} else {
				$checkbook = Checkbook::getCheckbookByCheckbookInvoiceDate($pdo);
				if($checkbook !== null) {
					$reply->data = $checkbook;
				} else {
					$checkbook = Checkbook::getCheckbookByCheckbookInvoiceNum($pdo);
					if($checkbook !== null) {
						$reply->data = $checkbook;


					} else {
						$checkbook = Checkbook::getAllCheckbooks($pdo);
						if($checkbook !== null) {
							$reply->data = $checkbook;
						}
						//if there is nothing in $id, and it is a GET request, then we simply return all checkbook. We store all checkbook in the $checkbook variable and then store them in the $reply->data state variable
					}
				}
			}


		catch
			(Exception $exception) {
				$reply->status = $exception->getCode();
				$reply->message = $exception->getMessage();
			} catch(TypeError $typeError) {
				$reply->status = $typeError->getCode();
				$reply->message = $typeError->getMessage();
			}
// in these lines the Exceptions are caught and the $reply object is updated with the data from the caught exception. Note that $reply->status will be updated with the correct error code in the case of an Exception

header("Content-type: application/json");
//sets up the response header.
if($reply->data === null) {
	unset($reply->data);
}


echo json_encode($reply);
//finally - JSON encodes the $reply object and sends it back to the front end.