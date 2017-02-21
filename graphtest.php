<?php
/**
 * This is a test of pchart
 *
 **/

/**
 * include all the classes
 **/
require __DIR__.'/vendor/autoload.php';

use CpChart\Chart\Draw;
use CpChart\Chart\Image;
use CpChart\Chart\Data;

/* Create your dataset object */
$myData = new Data();
/* Add data in your dataset */
$myData->addPoints(array(VOID,3,4,3,5));

$myPicture = new Image(700,230,$myData); // width, height, dataset
$myPicture->setGraphArea(60,40,670,190); // x,y,width,height
$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>11));


// define chart scale (default) and type of chart (spline)
$myPicture->drawScale();
$myPicture->drawSplineChart();

$myPicture->Stroke();




