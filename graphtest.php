<?php
/**
 * This is a test of pchart
 *
 **/

/**
 * include all the classes
 **/
require __DIR__.'/vendor/autoload.php';

/** Unneeded?
 * use CpChart\Chart\Draw;
**/
use CpChart\Chart\Image;
use CpChart\Chart\Data;

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
/* Create your dataset object */
$myData = new Data();
/* Add data in your dataset */
$myData->addPoints(array(10,3,4,3,5,20));

//create mock dataset matching expected value types from abq data set - name, payment ref number, invoice number, invoice date, payment date, invoice amount
//$testArray = array("TestVendor",123,42,2013-11-25,2013-12,25,50);
//$myRealData = new Data();
//$myRealData->addPoints(array(VOID,3,4,3,5));
//$testArray->addPoints(array(1,2,5,6));

$myPicture = new Image(300,300,$myData); // width, height, dataset
$myPicture->setGraphArea(50,30,300,250); // x,y,width,height
//$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>11));


// define chart scale (default) and type of chart (spline)
$myPicture->drawScale();
$myPicture->drawFilledSplineChart();

$myPicture->Stroke();




