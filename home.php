<?php

require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/UserData/StudentData.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Home';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{

}
else
{
    //If the user is not logged in bring them to the index page
    header('Location: index.php');
}

require_once('Views/home.phtml');