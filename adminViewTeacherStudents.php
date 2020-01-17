<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');
require_once('Models/UserData/ClassInfoData.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'View Teacher Class';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an ADMIN is logged in
    if ($_SESSION['user']->getRoleID() === '1')
    {

        if (isset($_POST['searchUser']))
        {
            $selectedTeacher = $dataSet->fetchUser($_POST['userName']);

            //Makes sure the user searched a teacher
            if (strtolower(substr($selectedTeacher->getUsername(), 0,1)) == 't'){

                //Creating an array for all of the ClassInfoData objects
                $view->allClasses = $dataSet->fetchAllClasses();

                //Retrieving all of the students
                $view->allStudents = $dataSet->fetchAllStudents();

                //Adding only students who have the same class ID as the teacher to 'teachersStudents'
                foreach ($view->allStudents as $student){
                    if ($student->getClassID() == $selectedTeacher->getClassID()){
                        $view->teachersStudents[] = $student;
                    }
                }
            }
            else{
                $view->error = 'Please search for a teacher';
            }
        }

    }
    else {
        header('Location: home.php');
    }
}
else
{
    header('Location: index.php');
}

require_once('Views/adminViewTeacherStudents.phtml');