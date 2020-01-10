<?php

session_start();

$view = new stdClass();
$view->user = null;

// To ensure login.php is not manually accessible to logged in user
if (isset($_SESSION['user']))
{
    header("Location: index.php");
}
require_once('Models/UserDataSet.php');
$user = new UserDataSet();

$view->pageTitle = "Log In";
$view->loginError = False;

if(isset($_POST['submit']))
{
    $success = $user->login($_POST['email'],$_POST['password']);

    if ($success === True)
    {
        header("Location: index.php");
    }
    else{
        $view->loginError = True;
    }
}
require_once('Views/login.phtml');