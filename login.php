<?php

session_start();

$view = new stdClass();
$view->user = null;
$view->success = null;

// To ensure login.php is not manually accessible to logged in user
if (isset($_SESSION['user']))
{
    header("Location: index.php");
}
require_once('Models/UserDataSet.php');
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/ClassData.php');
require_once('Models/UserData/StudentData.php');
require_once('Models/UserData/TeacherData.php');

$user = new UserDataSet();

$view->pageTitle = "Log In";
$view->loginError = False;

if(isset($_POST['submit']))
{
    $success = $user->login($_POST['username'],$_POST['password']);

    if (is_object($success))
    {
        header("Location: index.php");
    }
    else{
        $view->loginError = True;
    }
}
require_once('Views/login.phtml');