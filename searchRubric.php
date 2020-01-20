<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

//if(isset($_SESSION['user']))
//{
//    if($_SESSION['user']->getRoleID() == 1 ||  $_SESSION['user']->getRoleID() == 2){}
//    elseif($_SESSION['user']->getRoleID() == 3)
//    {
//        header("Location: myData.php");
//    }
//}
//else{
//    header("Location: index.php");
//}


if(isset($_SESSION['rubric']))
{
    unset($_SESSION['rubric']);
}

$view = new stdClass();
$view->pageTitle = 'Search Rubric';
$view->searchValue = null;
$view->searchResult = null;
$view->err  = null;

$handler = new rubricHandler();

//Checks if a USER has logged in
if((!isset($_SESSION['user'])))
{
    //Redirects to login if not
    header('Location: index.php');
}

if(isset($_POST['search']))
{
    $view->searchValue = $_POST['search'];
    $searchResult = $handler->searchRubric($_POST['search']);

    if(is_array($searchResult))
    {
        $view->searchResult = $searchResult;
    }else{
        $view->err = $searchResult;
    }
}

if(isset($_POST['submit']))
{
    $_SESSION['rubric_name'] = $_POST['rubric_name'];
    $_SESSION['timestamp'] = $_POST['timestamp'];

    header("Location: displayRubric.php");
}

require_once('Views/searchRubric.phtml');
