<?php

require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\AbqVast\Criteria;

/**
 *
 * api for the Criteria class
 *
 * @author Sarah Ruth Finkel <sfinkel@cnm.edu>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
// Here we create a new stdClass named $reply. A stdClass is basically an empty bucket that we can use to store things in.
// We will use this object named $reply to store the results of the call to our API. The status 200 line adds a state variable to $reply called status and initializes it with the integer 200 (success code). The proceeding line adds a state variable to $reply called data. This is where the result of the API call will be stored. We will also update $reply->message as we proceed through the API.


try {
	//grab the mySQL DataBase connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/abqvast.ini");

	//determines which HTTP Method needs to be processed and stores the result in $method.
	$method = array_key_exists("HTTP_x_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//stores the Primary Key for the GET and POST methods in $id. This key will come in the URL sent by the front end. If no key is present, $id will remain empty. Note that the input is filtered.
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$criteriaShareId = filter_input(INPUT_POST, "criteriaShareId", FILTER_VALIDATE_INT);
	$criteriaFieldId = filter_input(INPUT_POST, "criteriaFieldId", FILTER_SANITIZE_STRING);
	$criteriaOperator = filter_input(INPUT_POST, "criteriaOperator", FILTER_SANITIZE_STRING);
	$criteriaValue = filter_input(INPUT_POST, "criteriaValue", FILTER_SANITIZE_STRING);

	//make sure the id is valid for the methods that require it
	//THIS WAS MISSING
//	if(($method === "POST") && (empty($id) === true || $id < 0)) {
//		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
//	}

// Here, we determine if the request received is a GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");
		// handle GET request - if id is present, that criteria is present, that criteria is returned, otherwise all criteria are returned

		// Here, we determine if a Key was sent in the URL by checking $id. If so, we pull the requested Criteria by Criteria ID from the DataBase and store it in $criteria.
		if(empty($id) === false) {
			$criteria = Criteria::getCriteriaByCriteriaId($pdo, $id);
			if($criteria !== null) {
				$reply->data = $criteria;
				// Here, we store the retreived Criteria in the $reply->data state variable.
			}
		}
		// If there is nothing in $id, and it is a GET request, then we simply return all criteria. We store all the criteria in the $criteria variable, and then store them in the $reply->data state variable.

	} else if($method === "POST") {
// this line determines if the request is a POST request

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		// Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.

		$requestObject = json_decode($requestContent);
		// This line then decodes the JSON package and stores that result in $requestObject.

		if(empty($requestObject->criteriaId) === true) {
			throw(new \InvalidArgumentException ("No Criteria ID", 405));
		}
		if(empty($requestObject->criteriaFieldId) === true) {
			throw(new \InvalidArgumentException ("No Criteria Field IdL", 405));
		}
		if(empty($requestObject->criteriaShareId) === true) {
			throw(new \InvalidArgumentException ("No Criteria Share Id", 405));
		}
		if(empty($requestObject->criteriaOperator) === true) {
			throw(new \InvalidArgumentException ("Y U NO use right operator", 405));
		}
		if(empty($requestObject->criteriaValue) === true) {
			throw(new \InvalidArgumentException ("Where's the value in that?", 405));
		}

		// creates a new Criteria object and stores it in $criteria
		$criteria = new Criteria(null, $requestObject->criteriaFieldId, $requestObject->criteriaShareId, $requestObject->criteriaOperator, $requestObject->criteriaValue);
		// calls the INSERT method in $criteria which inserts the object into the DataBase.
		$criteria->insert($pdo);

		// stores the "Criteria created OK" message in the $reply->message state variable.
		$reply->message = "Criteria OK";

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