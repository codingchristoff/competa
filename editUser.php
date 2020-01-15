<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Edit User';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Fetching all of the classes for the drop down menu
$view->allClasses = $dataSet->fetchAllClassNames();

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an ADMIN is logged in
    if ($_SESSION['user']->getRoleID() === '1')
    {
        if (isset($_POST['searchUser']))
        {
            $view->allUsers = $dataSet->fetchUser($_POST['userName']);
        }
    }
}

require_once('Views/editUser.phtml');