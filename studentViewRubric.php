<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/StudentData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'View Rubric';

//Checks if user is logged in
if (isset($_SESSION['user'])){

    //Checks if user is a STUDENT
    if ($_SESSION['user']->getRoleID() == 3){

        //Check if a rubric was selected
        if (isset($_POST['submit'])){

            //Initiating database handler
            $handler = new RubricHandler();

            //Stores all of the current users fully assessed rubric's DATES into an array
            $view->dates = $handler->getDatesFromStudentID($_SESSION['user']->getUserID());

            $view->selectedDate = $_POST['timestamp'];

            //Creating a rubric for each date
            foreach ($view->dates as $date) {

                $assessedRubricsArray = $handler->createMarkedRubric($_SESSION['user']->getUserID(), $date);

                if ($view->selectedDate == $date) {

                    //First array holds the rubric objects
                    $rubricObject = $assessedRubricsArray[0];

                    //Only want the first value in the array (there is only 1 value in the array)
                    $view->rubric = $rubricObject[0];

                    $view->mergeIDs = $assessedRubricsArray[1];
                }
            }
        }
        else{
            header('Location: studentSelectRubric.php');
        }
    }
    //Redirects admin or teacher to their myData page
    else{
        header('Location: myData.php');
    }
}
//If no user is logged in redirect to login
else{
    header('Location: index.php');
}

require_once ('Views/studentViewRubric.phtml');

