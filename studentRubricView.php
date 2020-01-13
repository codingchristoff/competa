<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->user = null;
$view->rubricsInfo = null;
$view->newRubricsInfo = null;


if(isset($_SESSION['username']))
{
    $view->user = $_SESSION['username'];
}

if(isset($_SESSION['rubricsInfo']))
{
    $view->rubricsInfo = array_slice($_SESSION['rubricsInfo'], 0, -1);

    $view->rubricsInfoNew = array($view->rubricsInfo);
}

$view->pageTitle = 'Rubric View';

require_once('Views/studentRubricView.phtml');