<?php

require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/UserData/StudentData.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'My Data';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

// To ensure myData.php is not manually accessible to logged in user
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}

//Sets a user
$view->user = null;

//Checks if a user is set
if(isset($_SESSION['user']))
{
    //The user that is currently logged in
    $view->user = $_SESSION['user'];
}

require_once('Views/myData.phtml');