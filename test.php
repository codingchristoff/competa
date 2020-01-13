<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

$view = new stdClass();

$handler = new rubricHandler();

//$view->test = $handler->test("neque");

//echo $view->test->getRubricName();

//$view->test = $handler->retreiveRubric("neque");

//var_dump($handler->retreiveRubric("neque"));

var_dump($handler->retreiveCategory("congue"));