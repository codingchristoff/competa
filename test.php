<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

$view = new stdClass();

$handler = new rubricHandler();

//$view->test = $handler->test("neque");

//echo $view->test->getRubricName();

//$view->test = $handler->retrieveRubric("neque");

//var_dump($handler->retrieveRubric("Independent Learning"));

//var_dump($handler->retrieveCategory("vel"));

//var_dump($handler->retrieveCriteria("Nunc purus."));

//var_dump($handler->test("tree"));

//var_dump($handler->createRubric("Independent Learning"));

//var_dump($handler->createCategory("Active lesson start"));

//var_dump($handler->test("tree"));

//this is what needs to be established and passed to our retrieveDate method

//$t=time();
//date_default_timezone_set('UTC');
//echo($t . "<br>");
//echo(date("d-m-Y H:m:s",$t));

//var_dump($handler->retrieveDate("2020-01-10 13:04:15"));

//var_dump($handler->criteriaCategory("I do not follow the five basic rules that apply in every classroom."));

//var_dump($handler->createDate(""))

//var_dump($handler->buildRubric("2020-01-10 13:04:15"));

//var_dump($handler->searchRubric("neque"));

//var_dump($handler->retrieveRubricGroupOnID("1"));

//var_dump($handler->retrieveRubricGroupOnID("1"));

var_dump($handler->buildRubric("2019-12-05 00:00:00", "neque"));

