<?php
/**
 * This creates a chart via the PChart library.
 */

//Loads the autoload.php file from the vendor directory.
require dirname(__DIR__)."vendor/autoload.php";

//loads the Image and Data files from PChart
use CpChart\Chart\Image;
use CpChart\Chart\Data;

//starts the session if it is not already active.
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//create dataset object
$sourceData = new Data();
//fill dataset object with data - will need to be expanded to respond to user's input
$sourceData ->addPoints(array(42,44,48,56,72));



