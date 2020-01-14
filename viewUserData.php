<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');

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

        if (isset($_POST['searchUser']))
        {
            $view->allUsers = $dataSet->searchUser($_POST['userName']);
        }
    }
    else if ($_SESSION['user']->getRoleID() === '2')
    {
        $view->classStudents = $dataSet->fetchStudentsInClass($_SESSION['user']->getClassID());
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