<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->user = null;


if(isset($_SESSION['username']))
{
    $view->user = $_SESSION['username'];
}

if(isset($_POST))
{

}

$view->pageTitle = 'Rubric Create';

require_once('Views/adminRubricCreate.phtml');
