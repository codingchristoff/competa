<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/StudentData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Results';

//Checks if user is logged in
if (isset($_SESSION['user'])){

    //Checks if user is a STUDENT
    if ($_SESSION['user']->getRoleID() == 3){

        //Initiating database handler
        $handler = new RubricHandler();

        //Stores all of the current users fully assessed rubric's DATES into an array
        $view->dates = $handler->getDatesFromStudentID($_SESSION['user']->getUserID());
        //$view->dates = array_unique($view->dates);

        $counter = 0;

        //Creating a rubric for each date
        foreach ($view->dates as $date) {

            $assessedRubricsArray = $handler->createMarkedRubric($_SESSION['user']->getUserID(), $date);

            if ($assessedRubricsArray != false) {

                //First array holds the rubric objects
                $rubricObjects = $assessedRubricsArray[0];

                //Only want the first value in the array (there is only 1 value in the array)
                $view->rubrics[] = $rubricObjects[0];

                $view->mergeIDs[] = $assessedRubricsArray[1];
            } else {
                $view->error = 'No marked rubrics available';
            }
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

require_once ('Views/studentSelectRubric.phtml');


