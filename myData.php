<?php

require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'My Data';

//Sets a user
$view->user = null;
$view->userName = null;

//Checks if a user is set
if(isset($_SESSION['user']))
{
    //The user that is currently logged in
    $view->user = $_SESSION['user'];

    var_dump($view->user);
}

require_once('Views/myData.phtml');