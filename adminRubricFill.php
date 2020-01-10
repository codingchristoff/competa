<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->user = null;


if(isset($_SESSION['user']))
{
    $view->user = $_SESSION['user'];
}

$view->pageTitle = 'Rubrics Fill';

require_once('Views/adminRubricFill.phtml');
