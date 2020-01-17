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
    $view->timestamp = $_SESSION['timestamp'];
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //hello
//Click to assign a rubric to a class
if(isset($_POST['assign']))
{   // gets teacher ID from session
    $teacherID = $_SESSION['user']->getUserID();
    //gets the teacher's class ID
    $teacherClassID = $_SESSION['user']->getClassID($teacherID);
    $studentList = [];
    //gets all students in that teacher's class and puts them in an array
    $studentList = $userHandler->getStudentsInClass($teacherClassID);

    //for each student in the table, loop through to compare with each other student
    foreach ($studentList as $currentStudent)
    {
        //records the necessary data of the student being compared
        $currentID = $currentStudent['studentID'];
        $currentTableGroup = $currentStudent['tableGroup'];
        //Used to exit the loop early to save time
        $isSearched = false;
        // goes through the array again
        foreach ($studentList as $targetStudent)
        {
            // table group is wrong and is searched are true
            if ( $currentTableGroup != $targetStudent['tableGroup'] && $isSearched == true)
            {
                //Breaks out of the if and current for each loop
                break;
            }
            // table group matches
            elseif ($currentTableGroup == $targetStudent['tableGroup'])
            {
                $dateID = $handler->getDateID($_SESSION['timestamp']);

                $userHandler->insertStudentAssignment($teacherID,$currentID,$dateID,$targetStudent['studentID']);
            }
            // table is different and searched is false
            elseif($currentTableGroup != $targetStudent['tableGroup'] && $isSearched == false)
            {

            }
            else{echo "An error has occurred assigning rubric to class.";}
        }
    }
}

require_once('Views/displayRubric.phtml');