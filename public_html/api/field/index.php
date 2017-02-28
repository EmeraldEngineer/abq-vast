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

	//make sure the id is valid for the methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

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

	} else if($method === "POST") {
// this line determines if the request is a POST request

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		// Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.

		$requestObject = json_decode($requestContent);

		// This line then decodes the JSON package and stores that result in $requestObject.

		//Here we check to make sure that there is content for the Field. If $requestObject->fieldId is empty, an exception is thrown. POST method will use the content to create a new Tweet.
		/**      if(empty($requestObject->fieldId) === true) {
		 * throw(new \InvalidArgumentException ("No Field ID", 405));
		 * }
		 *
		 * if(empty($requestObject->fieldName) === true) {
		 * throw(new \InvalidArgumentException ("No Field Name", 405));
		 * }
		 *
		 * if(empty($requestObject->fieldType) === true) {
		 * throw(new \InvalidArgumentException ("No Field Type", 405));
		 * }
		 **/
		// creates a new Field object and stores it in $field
		$field = new Field(null, $requestObject->fieldName, $requestObject->fieldType);
		// calls the INSERT method in $field which inserts the object into the DataBase.
		$field->insert($pdo);

		// stores the "Field created OK" message in the $reply->message state variable.
		$reply->message = "Field OK";

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