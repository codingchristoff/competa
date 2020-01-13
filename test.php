<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

$view = new stdClass();

$handler = new rubricHandler();

//$view->test = $handler->test("neque");

//echo $view->test->getRubricName();

//$view->test = $handler->retreiveRubric("neque");

//var_dump($handler->retreiveRubric("neque"));

//var_dump($handler->retreiveCategory("vel"));

//var_dump($handler->retreiveCriteria("Nunc purus."));

//var_dump($handler->test("tree"));

//this is what needs to be established and passed to our retrieveDate method

//$t=time();
//date_default_timezone_set('UTC');
//echo($t . "<br>");
//echo(date("d-m-Y H:m:s",$t));

var_dump($handler->retrieveDate("2020-01-10 13:04:15"));