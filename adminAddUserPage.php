<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Add User';

/**
if(isset($_SESSION['user']))
{
    $view->user = $_SESSION['user'];
}
**/





require_once('Views/adminAddUserPage.phtml');