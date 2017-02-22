<?php
/**
 * This creates a chart via the PChart library.
 */

//Loads the autoload.php file from the vendor directory.
require dirname(__DIR__)."/vendor/autoload.php";

//loads the Image and Data files from PChart
use CpChart\Chart\Draw;
use CpChart\Chart\Image;
use CpChart\Chart\Data;

//starts the session if it is not already active.
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//create dataset object
$sourceData = new Data();
//fill dataset object with data - will need to be expanded to pull data mySQL based upon user's input
$sourceData->addPoints(array(4200,4400,4800,5600,7200,9001));

$sourceData->setAxisName(0,"HYPE");
$sourceData->setXAxisName("Time");

//create image canvas (currently set to 16/9 ratio), specify source data
$chartImage = new Image(800,450,$sourceData);
//define x,y,width,height of the graph on the canvas
$chartImage->setGraphArea(100,100,700,350);



//define chart scale - default - some graph types require this
$chartImage->drawScale();
//define type of chart, in this case a line chart
$chartImage->drawLineChart();

//draw image
$chartImage->stroke();


