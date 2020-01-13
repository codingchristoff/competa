<?php
require_once('Models/UserData/UserData.php');

session_start();

$view = new stdClass();
$view->user = null;
$view->rubricsInfo = null;
$view->newRubricsInfo = array();


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


    while($lengthCount < 3)
    {
        $offset = $indexDivide * $offsetCount;
        $length = $indexDivide * $lengthCount;

        $view->newRubricsInfo[$dimension][$offsetCount] = array_slice($view->rubricsInfo, $offset, -$length);

        var_dump($offset);
        var_dump($length);
        $offsetCount--;
        $lengthCount++;
    }


}

$view->pageTitle = 'Rubric View';

require_once('Views/studentRubricView.phtml');