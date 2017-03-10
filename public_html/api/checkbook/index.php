<?php

require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\AbqVast\Checkbook;

/**
 * api for checkbook class
 *
 * @authors Sarah Ruth Finkel <srfinkel@gmail.com>, Taylor McCarthy <oresshi@gmail.com>
 **/

function paginate($arr, $pageNum) {
	$arr = array(\PDO $checkbooks);
	$pageNum->this = 0;
	return $pageSize = array_slice($arr, 0, 100, true);
}

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
	$checkbookInvoiceAmount = filter_input(INPUT_GET, "checkbookInvoiceAmount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$checkbookInvoiceLowAmount = filter_input(INPUT_GET, "checkbookInvoiceLowAmount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$checkbookInvoiceHighAmount = filter_input(INPUT_GET, "checkbookInvoiceHighAmount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$checkbookInvoiceDate = filter_input(INPUT_GET, "checkbookInvoiceDate");
	$checkbookInvoiceSunriseDate = filter_input(INPUT_GET, "checkbookInvoiceSunriseDate");
	$checkbookInvoiceSunsetDate = filter_input(INPUT_GET, "checkbookInvoiceSunsetDate");
	$checkbookInvoiceNum = filter_input(INPUT_GET, "checkbookInvoiceNum", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$checkbookPaymentDate = filter_input(INPUT_GET, "checkbookPaymentDate");
	$checkbookPaymentSunriseDate = filter_input(INPUT_GET, "checkbookPaymentSunriseDate");
	$checkbookPaymentSunsetDate = filter_input(INPUT_GET, "checkbookPaymentSunsetDate");
	$checkbookReferenceNum = filter_input(INPUT_GET, "checkbookReferenceNum", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$checkbookVendor = filter_input(INPUT_GET, "checkbookVendor", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
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
			$reply->data = Checkbook::getCheckbookByCheckbookId($pdo, $id);
		} elseif(empty($checkbookInvoiceHighAmount) === false && empty($checkbookInvoiceLowAmount) === false) {
			$reply->data = Checkbook::getCheckbookByCheckbookInvoiceAmount($pdo, $checkbookInvoiceLowAmount, $checkbookInvoiceHighAmount)->toArray();
		} elseif(empty($checkbookInvoiceSunriseDate) === false && empty($checkbookInvoiceSunsetDate) === false) {
			$checkbookInvoiceSunriseDate = \DateTime::createFromFormat("U", floor($checkbookInvoiceSunriseDate / 1000));
			$checkbookInvoiceSunsetDate = \DateTime::createFromFormat("U", ceil($checkbookInvoiceSunsetDate / 1000));
			$reply->data = Checkbook::getCheckbookByCheckbookInvoiceDate($pdo, $checkbookInvoiceSunriseDate, $checkbookInvoiceSunsetDate)->toArray();
		} elseif(empty($checkbookInvoiceNum) === false) {
			$reply->data = Checkbook::getCheckbookByCheckbookInvoiceNum($pdo, $checkbookInvoiceNum)->toArray();
		} elseif(empty($checkbookPaymentSunriseDate) === false && empty($checkbookPaymentSunsetDate) === false) {
			$checkbookPaymentSunriseDate = \DateTime::createFromFormat("U", floor($checkbookPaymentSunriseDate / 1000));
			$checkbookPaymentSunsetDate = \DateTime::createFromFormat("U", ceil($checkbookPaymentSunsetDate / 1000));
			$reply->data = Checkbook::getCheckbookByCheckbookPaymentDate($pdo, $checkbookPaymentSunriseDate, $checkbookPaymentSunsetDate)->toArray();
		} elseif(empty($checkbookReferenceNum) === false) {
			$reply->data = Checkbook::getCheckbookByCheckbookReferenceNum($pdo, $checkbookReferenceNum)->toArray();
		} elseif(empty($checkbookVendor) === false) {
			$reply->data = Checkbook::getCheckbookByCheckbookVendor($pdo, $checkbookVendor)->toArray();
		} else {
			$checkbook = Checkbook::getAllCheckbooks($pdo);
			if($checkbook !== null) {
				$reply->data = $checkbook;
			}
		}
	}

} catch
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