<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Delete User';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an ADMIN is logged in
    if ($_SESSION['user']->getRoleID() === '1')
    {
        //For when a user is searched
        if (isset($_POST['searchUser']))
        {
            $view->user = $dataSet->fetchUser($_POST['userName']);
        }

        //Check if user should be deleted
        if (isset($_POST['deleteUser']))
        {
            //Deletes the user
            $dataSet->deleteUser($_POST['userName']);
        }
    }
    else
    {
        header('Location: myData.php');
    }
}
else
{
    header('Location: index.php');
}

require_once('Views/adminDeleteUser.phtml');
