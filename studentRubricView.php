<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->user = null;
$view->rubricsInfo = null;
$view->twoRubricsInfo = array();
$view->threeRubricsInfo = array();


if(isset($_SESSION['username']))
{
    $view->user = $_SESSION['username'];
}

if(isset($_SESSION['rubricsInfo']))
{
    $view->rubricsInfo = array_slice($_SESSION['rubricsInfo'], 0, -1);

    $dimension = 0;
    $rubric = $_SESSION['rubric_count'];
    $category = $_SESSION['category_count'];
    $criteria = $_SESSION['criteria_count'];

    $indexDivide = count($view->rubricsInfo)/$rubric;
    $lengthCount = 0;
    $offsetCount = $rubric-1;


    while($lengthCount < $rubric)
    {
        $offset = $indexDivide * $offsetCount;

        $view->twoRubricsInfo[$offsetCount] = array_slice($view->rubricsInfo, $offset, $indexDivide);

        $arr_count = count($view->twoRubricsInfo[$offsetCount]);


        $offsetCount--;
        $lengthCount++;
    }

    $view->threeRubricsInfo = array();
}

$view->pageTitle = 'Rubric View';

require_once('Views/studentRubricView.phtml');