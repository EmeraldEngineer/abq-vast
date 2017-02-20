<?php

require_once "../../classes/autoloader.php";
require_once "../lib/xsrf.php";
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

	//stores the Primary Key for the GET, DELETE, and PUT methods in $id. This key will come in the URL sent by the front end. If no key is present, $id will remain empty. Note that the input is filtered.
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//Here we check and make sure that we have the Primary Key for the DELETE and PUT requests. If the request is a PUT or DELETE and no key is present in $id, An Exception is thrown.
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

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

		} else {
			$criteria = Criteria::getAllCriteria($pdo);
			if($criteria !== null) {
				$reply->data = $criteria;
			}
		}
		// If there is nothing in $id, and it is a GET request, then we simply return all criteria. We store all the criteria in the $criteria variable, and then store them in the $reply->data state variable.

	} elseif($method === "PUT" || $method === "POST") ;

	verifyXsrf();
	$requestContent = file_get_contents("php://input");
	$requestObject = json_decode($requestContent);

	//make sure criteria field id is available (required field)
	if(empty($requestObject->criteriaFieldId) === true) {
		throw(new \InvalidArgumentException ("No search criteria selected.", 405));
	}

	// make sure criteria share id is accurate (optional field)
	if(empty($requestObject->criteriaShareId) === true) {
		$requestObject->tweetDate = new \DateTime();
	}

	//  make sure profileId is available
	if(empty($requestObject->profileId) === true) {
		throw(new \InvalidArgumentException ("No Profile ID.", 405));
	}

	//perform the actual put or post
	if($method === "PUT") {

		// retrieve the tweet to update
		$tweet = Tweet::getTweetByTweetId($pdo, $id);
		if($tweet === null) {
			throw(new RuntimeException("Tweet does not exist", 404));
		}

		// update all attributes
		$tweet->setTweetDate($requestObject->tweetDate);
		$tweet->setTweetContent($requestObject->tweetContent);
		$tweet->update($pdo);

		// update reply
		$reply->message = "Tweet updated OK";

	} else if($method === "POST") {

		// create new tweet and insert into the database
		$tweet = new Tweet(null, $requestObject->profileId, $requestObject->tweetContent, null);
		$tweet->insert($pdo);

		// update reply
		$reply->message = "Tweet created OK";
	}

// update reply with exception information

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