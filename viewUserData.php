<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');
require_once('Models/UserData/ClassInfoData.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'View User';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an ADMIN is logged in
    if ($_SESSION['user']->getRoleID() === '1')
    {
        $view->allStudents = $dataSet->fetchAllStudents();
        $view->allTeachers = $dataSet->fetchAllTeachers();
        $view->allAdmins = $dataSet->fetchAllAdmins();

        //Creating an array for all of the ClassInfoData objects
        $view->allClasses = $dataSet->fetchAllClasses();

        if (isset($_POST['searchUser']))
        {
            $view->allUsers = $dataSet->searchUser($_POST['userName']);
        }
    }
    //Checks if TEACHER is logged in
    else if ($_SESSION['user']->getRoleID() ===  '2')
    {
        //Creating an array for all of the ClassInfoData objects
        $view->allClasses = $dataSet->fetchAllClasses();

        //Retrieving all of the students
        $view->allStudents = $dataSet->fetchAllStudents();

        //Adding only students who have the same class ID as the teacher to 'classStudents'
        foreach ($view->allStudents as $student){
            if ($student->getClassID() == $_SESSION['user']->getClassID()){
                $view->classStudents[] = $student;
            }
        }

    }
    else {
        header('Location: myData.php');
    }
}
else
{
    header('Location: index.php');
}

require_once('Views/viewUserData.phtml');