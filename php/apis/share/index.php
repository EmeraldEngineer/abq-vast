<?php

require_once "../../classes/autoloader.php";
require_once "/lib/xsrf.php"
require_once("/etc/apache2/abq-vast-mysql/encrypted-config.php");

use Users\Adam\Desktop\BootCamp\GIT\abq-vast\php\apis\Share\index.php;

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
$share = new stdClass();
$share ->status = 200;
$share ->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/abq-vast-mysql/share.ini");

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

	//handle GET request - if NNN is present, that share is returned, otherwise all shares are returned
	if($method === "GET") {
	//set XSRF cookie
		setXsrfCookie();


	}
}





