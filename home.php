<?php

require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/UserData/StudentData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Home';

//TESTING
$view->outstandingRubrics = null;
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
        $outstandingRubricsArray = $handler->getAssignedRubricAsClass($_SESSION['user']->getUserID());
        //var_dump($outstandingRubricsArray);

        foreach ($outstandingRubricsArray as $value) {
            $outstandingRubrics = $dataSet->getAssignedRubricForStudent($value['teacherID'], $value['rubricDate'], $value['targetStudent']);
            //var_dump($view->outstandingRubrics);

            if (is_array($outstandingRubrics)) {
                $view->outstandingRubrics[] = $outstandingRubrics;
                //var_dump($view->outstandingRubrics);
            } else {
                $view->err = $outstandingRubrics;
            }
        }
        //Check if the submit button has been pressed
        if(isset($_POST['assess']))
        {
            $_SESSION['rubric_name'] = $_POST['rubric_name'];
            $_SESSION['rubricDate'] = $handler->getDateID($_POST['rubricDate']);
            $_SESSION['targetID'] = $_POST['targetStudentID'];

            //var_dump($_SESSION['targetID']);

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