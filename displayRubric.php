<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');


session_start();

$view = new stdClass();
$view->pageTitle = 'Display Rubric';
$view->rubric = null;
$view->rubric_id = null;
$view->rubric_name = null;
$view->cats = array();
$view->runTimestamp = null;


$handler = new rubricHandler();

if(isset($_SESSION['rubric_name']))
{
    $_SESSION['rubric'] = $handler->buildRubric($_SESSION['timestamp'], $_SESSION['rubric_name']);
    $view->runTimestamp = $_SESSION['timestamp'];
}
if(isset($_SESSION['rubric']))
{
    $view->rubric = $_SESSION['rubric'];
    $view->rubric_id = $view->rubric->getRubricID();
    $view->rubric_name = $view->rubric->getRubricName();
    $view->cats = $view->rubric->getCategories();
}

if(isset($_POST['submit']))
{
    $arrayVals = array_slice($_POST, 0, -1);

    $message = false;

    $dateID = $handler->checkDate($handler->getTimestamp());

    foreach ($arrayVals as $value)
    {
        $success = $handler->insertAssessmentValues($value, $dateID);
        $message = true;
    }

    if($message === true)
    {
        echo "This data has been sent to the database";
    }

}

//Click to assign a rubric to a class
if(isset($_POST['assign']))
{
    $teacherID = $_SESSION['user']->getRoleID();
    $teacherClassID = $_SESSION['user']->getTeachersClassID($teacherID);
}

require_once('Views/displayRubric.phtml');