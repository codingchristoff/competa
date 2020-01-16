<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

$view = new stdClass();
$view->user = null;
$view->rubric_count = 1;
$view->category_count = 4;
$view->criteria_count = 4;
$handler = new rubricHandler();

if(isset($_SESSION['user']))
{
    $view->user = $_SESSION['user'];
}

if(isset($_SESSION['category_count']))
{
//    $view->rubric_count = $_SESSION['rubric_count'];
    $view->criteria_count_cols = $_SESSION['category_count']-1;
    $view->criteria_count = $_SESSION['criteria_count'];
}

if(isset($_SESSION['rubricsInfo']))
{
    unset($_SESSION['rubricsInfo']);
}

if(isset($_POST['submit']))
{
    //$_SESSION['rubricsInfo'] = $_POST;

    $ArrayCut = array_slice($_POST, 0, -1);
    $extractRubricName = array_slice($ArrayCut, 0, -count($ArrayCut)+1);
    $arrayTwo = array_slice($ArrayCut, 1);
    $rubricName = $extractRubricName[0];

    $offsetCount = $_SESSION['category_count']; // if 4x4 cat/crit then 5
    $lengthCount = $_SESSION['criteria_count']-1; // if 4x4 cat/crit then 3

    $count = 0; // offset counter
    $down = $lengthCount;

    $arrayFinalCount = 0;


    $arrayFinal = array();

    while($count <= $lengthCount)
    {
        $offsetVal = $offsetCount * $count;
        $lengthVal = $offsetCount * $down;

        if ($lengthVal != 0)
        {
            $arrayTemp = array_slice($arrayTwo, $offsetVal, -$lengthVal);
        }else{
            $arrayTemp = array_slice($arrayTwo, $offsetVal);
        }

        $category_name = array_shift($arrayTemp);

        foreach ($arrayTemp as $key => $val)
        {
            $arrayFinal[$arrayFinalCount] = "{$rubricName},{$category_name},{$val}";
            $arrayFinalCount++;
        }

        $count++;
        $down--;

    }

    $dateID = $handler->checkDate($handler->getTimestamp());

    foreach ($arrayFinal as $row)
    {
        var_dump($row);
        echo $handler->insertRubricData($row, $dateID);
    }

}

$view->pageTitle = 'Rubrics Fill';
require_once('Views/adminRubricFill.phtml');
