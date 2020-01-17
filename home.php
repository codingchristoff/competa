<?php

require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/UserData/StudentData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Home';

//TESTING
$view->searchValue = null;
$view->searchResult = null;
$view->err  = null;

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Handles rubric information
$handler = new rubricHandler();
$view->handler = $handler;

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //If a user is a student
    if($_SESSION['user']->getRoleID()==3)
    {
        //Gets outstanding rubrics that the user has
        //$view->outstandingRubrics = $handler->
        //Check if the submit button has been pressed
        if(isset($_POST['submit']))
        {
            $_SESSION['rubric_name'] = $_POST['rubric_name'];
            $_SESSION['timestamp'] = $_POST['timestamp'];

            header("Location: displayRubric.php");
        }
    }
}
else
{
    //If the user is not logged in bring them to the index page
    header('Location: index.php');
}

require_once('Views/home.phtml');