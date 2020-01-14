<?php

session_start();

$view = new stdClass();
$view->user = null;
$view->success = null;

if (isset($_SESSION['username']))
{
    //Change this for a more suitable page later !!!!!!!!!!!!!!!!!!!!!
    header("Location: myData.php");
}

// To ensure login.php is not manually accessible to logged in user

require_once('Models/UserData/UserDataSet.php');
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/ClassData.php');
require_once('Models/UserData/StudentData.php');
require_once('Models/UserData/TeacherData.php');

$userDataSet = new UserDataSet();

$view->pageTitle = "Log In";
$view->loginError = False;

if(isset($_POST['submit']))
{
    $tempUser = $userDataSet->login($_POST['username'],$_POST['password']);

    if ($tempUser != null)
    {
        $_SESSION['user'] = $tempUser;
    }
    else{
        $view->loginError = True;
    }
}
require_once('Views/index.phtml');