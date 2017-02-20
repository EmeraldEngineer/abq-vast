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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/tweet.ini");



	//determines which HTTP Method needs to be processed and stores the result in $method.
	$method = array_key_exists("HTTP_x_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//stores the Primary Key for the GET, DELETE, and PUT methods in $id. This key will come in the URL sent by the front end. If no key is present, $id will remain empty. Note that the input is filtered.
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);



	//Here we check and make sure that we have the Primary Key for the DELETE and PUT requests. If the request is a PUT or DELETE and no key is present in $id, An Exception is thrown.
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
}
