<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

//if(isset($_SESSION['user']) && $_SESSION['user']->getRoleID() == 1 ||  $_SESSION['user']->getRoleID() == 2) {}
//elseif(isset($_SESSION['user']) && $_SESSION['user']->getRoleID() == 3)
//{
//    header("Location: myData.php");
//}
//else{
//    header("Location: index.php");
//}


session_start();

$view = new stdClass();
$view->pageTitle = 'Display Rubric';
$view->rubric = null;
$view->rubric_id = null;
$view->rubric_name = null;
$view->cats = array();


$handler = new rubricHandler();

if(isset($_SESSION['rubric_name']))
{
    $_SESSION['rubric'] = $handler->buildRubric($_SESSION['timestamp'], $_SESSION['rubric_name']);
}
if(isset($_SESSION['rubric']))
{
    $view->rubric = $_SESSION['rubric'];
    $view->rubric_id = $view->rubric->getRubricID();
    $view->rubric_name = $view->rubric->getRubricName();
    $view->cats = $view->rubric->getCategories();
}

require_once('Views/displayRubric.phtml');