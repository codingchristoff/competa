<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Search Rubric';
$view->searchValue = null;
$view->searchResult = null;
$view->err  = null;

$handler = new rubricHandler();

if(isset($_POST['search']))
{
    $view->searchValue = $_POST['search'];
    $searchResult = $handler->searchRubric($_POST['search']);

    if(is_array($searchResult))
    {
        $view->searchResult = $searchResult;
    }else{
        echo $view->err = $searchResult;
    }
}

require_once('Views/searchRubric.phtml');
