<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->user = null;
$view->rubric_count = 2;
$view->category_count = 4;
$view->criteria_count = 4;

if(isset($_SESSION['user']))
{
    $view->user = $_SESSION['user'];
}

if(isset($_SESSION['rubric_count']))
{
    $view->rubric_count = $_SESSION['rubric_count'];
    $view->criteria_count_cols = $_SESSION['category_count'];
    $view->criteria_count = $_SESSION['criteria_count'];
}

if(isset($_SESSION['rubricsInfo']))
{
    unset($_SESSION['rubricsInfo']);
}

if(isset($_POST['submit']))
{
    $_SESSION['rubricsInfo'] = $_POST;
    header("Location: studentRubricView.php");
}

$view->pageTitle = 'Rubrics Fill';
require_once('Views/adminRubricFill.phtml');
