<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->user = null;


if(isset($_SESSION['user']))
{
    $view->user = $_SESSION['user'];

    if ($_SESSION['user']->getRoleID() === '1')
    {
        if(isset($_POST['submit']))
        {
            //$_SESSION['rubric_count'] = $_POST['rubric_count'];
            $_SESSION['category_count'] = $_POST['category_count'];
            $_SESSION['criteria_count'] = $_POST['criteria_count'];

            header("Location: adminRubricFill.php");
        }
    }
    else
    {
        header('Location: home.php');
    }
}
else
{
    header('Location: index.php');
}

$view->pageTitle = 'Rubric Create';

require_once('Views/adminRubricCreate.phtml');
