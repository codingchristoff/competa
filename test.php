<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/UserDataSet.php');
require_once('Models/RubricSet/rubricHandler.php');

$view = new stdClass();

$handler = new rubricHandler();
$userHandler = new UserDataSet();

//$view->test = $handler->test("neque");

//echo $view->test->getRubricName();

//$view->test = $handler->retrieveRubric("neque");

//var_dump($handler->retrieveRubricID("magna ac"));

//var_dump($handler->retrieveCategoryID("I always listen."));

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

//var_dump($handler->retrieveDateID("2020-01-14 17:24:05"));

//var_dump($handler->criteriaCategory("I do not follow the five basic rules that apply in every classroom."));

/*
$timestamp = date('Y-m-d H:i:s');
var_dump($handler->createDate($timestamp));
*/

//var_dump($handler->buildRubric("2020-01-10 13:04:15"));

//var_dump($handler->searchRubric("neque"));

//var_dump($handler->retrieveRubricGroupOnID("1"));

//var_dump($handler->retrieveRubricGroupOnID("1"));

//var_dump($handler->buildRubric("2019-12-05 00:00:00", "neque"));

//var_dump($timestamp = $handler->getTimestamp());
//var_dump($handler->insertAssessmentValues("4","70","4", $timestamp));

//var_dump($handler->retrieveMergeID("1","1","1"));

//################ INSERTION TEST ################


//var_dump($rubricID = $handler->checkRubric("hubba bubba bubba"));
//var_dump($categoryID = $handler->checkCategory("Test Test"));
//var_dump($criteriaID = $handler->checkCriteria("Test Test"));
//var_dump($handler->checkMergeID($rubricID, $categoryID, $criteriaID));

//var_dump($handler->createCriteria("I do use the right manners."));
//var_dump($handler->checkCriteria("Good"));
//var_dump($handler->retrieveCriteriaID("Nulla nisl."));

//var_dump($handler->createCategory("I always listen."));
//var_dump($handler->checkCategory("I always listen."));
//var_dump($handler->checkRubric("Shared Learning"));
//var_dump($handler->retrieveCriteriaID("Nunc nisl."));
//var_dump($handler->retrieveCategoryID("vel"));
//var_dump($handler->checkDate("2022-01-10 13:04:15"));
//var_dump($handler->retrieveMergeID("1", "1", "1"));


//var_dump($handler->retrieveMergeID("1","1","1"));

//var_dump($handler->getDatesFromStudentID(52));

//$str = "h,e,l,l,o";
/*
var_dump(substr($str, 0,1));
var_dump(substr($str, 0,2));
var_dump(substr($str, 2,1));
var_dump(explode(",",$str));
*/

//$explosion = explode(",",$str);

//echo $explosion[2];

//var_dump($handler->retrieveDateID("1,2,3,4,5,2019-12-05 00:00:00"));
//
//$str = ("1,2,3,4,5,2019-12-05 00:00:00");
//$explosion = explode(",", $str);
//
//echo $explosion[5];
//echo $rubricDate = $handler->retrieveDateID($explosion[5]);

//var_dump($handler->getDatesFromStudentID(1));
//var_dump($handler->createMarkedRubric(1,"2020-01-16 12:24:12"));

//var_dump($userHandler->getTeachersClassID("2"));

//var_dump($userHandler->getStudentsInClass(11));

var_dump($userHandler->insertStudentAssignment("2","322","1","22"));