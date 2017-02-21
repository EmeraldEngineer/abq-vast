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

// define chart scale (default) and type of chart (spline)
$myPicture->drawScale();
$myPicture->drawSplineChart();


