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

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$shareImage = filter_input(INPUT_POST, "shareImage", FILTER_SANITIZE_STRING);
	$shareUrl = filter_input(INPUT_POST, "shareUrl", FILTER_SANITIZE_STRING);

	//make sure the is is valid for the methods that require it
	if(($method === "POST") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	// handle GET request - if id is present, that share is present, that share is returned, otherwise all share are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		// Here, we determine if a Key was sent in the URL by checking $id. If so, we pull the requested Share by Share ID from the DataBase and store it in $share.
		if(empty($id) === false) {
			$share = Share::getShareByShareId($pdo, $id);
			if($share !== null) {
				$reply->data = $share;
			}
		}

		// If there is nothing in $id, and it is a GET request, then we simply return all share. We store all the share in the $share variable, and then store them in the $reply->data state variable.

	} else if($method === "POST") {
// this line determines if the request is a POST request

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		// Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.


		$requestObject = json_decode($requestContent);
		// This line then decodes the JSON package and stores that result in $requestObject.


		//Here we check to make sure that there is content for the Tweet. If $requestObject->criteriaId is empty, an exception is thrown. POST method will use the content to create a new Tweet.
		if(empty($requestObject->shareId) === true) {
			throw(new \InvalidArgumentException ("No content for share Id", 405));
		}

	} else if($method === "POST") {
		// If it is a POST request we continue to the proceeding lines and make sure that a Profile ID was sent with the request. A new Criteria cannot be created without the crieteria Id. See the constructor in the Criteria class.
		//make sure criteriaId is available
		if(empty($requestObject->shareId) === true) {
			throw(new \InvalidArgumentException ("No Share ID", 405));
		}

		// creates a new Criteria object and stores it in $criteria
		$share = new Share(null, $requestObject->shareImage, $requestObject->shareUrl);
		// calls the INSERT method in $criteria which inserts the object into the DataBase.
		$share->insert($pdo);

		// stores the "Criteria created OK" message in the $reply->message state variable.
		$reply->message = "Share OK";

	} else {
		throw (new InvalidArgumentException("Invalid HTTP Method Request"));
		// If the method request is not GET, PUT, POST, or DELETE, an exception is thrown
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