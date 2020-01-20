<?php
require_once('Models/UserData/UserData.php');
require_once('Models/RubricSet/rubricHandler.php');

session_start();

$view = new stdClass();
$view->user = null;
$view->rubric_count = 1;
$view->criteria_count = null;
$view->success = False;
$handler = new rubricHandler();

if(isset($_SESSION['user']))
{
    $view->user = $_SESSION['user'];

    //Checks if an ADMIN is logged in
    if ($_SESSION['user']->getRoleID() === '1')
    {
        if(isset($_SESSION['category_count']))
        {
            $view->criteria_count_cols = $_SESSION['category_count']-1;
            $view->criteria_count = $_SESSION['criteria_count'];
        }

        if(isset($_SESSION['rubricsInfo']))
        {
            unset($_SESSION['rubricsInfo']);
        }

        if(isset($_POST['submit']))
        {

            $ArrayCut = array_slice($_POST, 0, -1); // Removing submit key from POST Array
            $rubricName = array_shift($ArrayCut); // remove rubric name from array and assign to var

            $ArrCount = count($ArrayCut); // counting the array w/removed rubric name
            $categoryCount = ($_SESSION['category_count']-1); // Getting true category count
            $indexCat = $ArrCount/$categoryCount; // index of the first category occurrence after 0

            $count = 0; // to allow for *0,*1,*2 ...

            $dateID = $handler->checkDate($handler->getTimestamp());

            while($count < $categoryCount)
            {
                $offsetVal = $indexCat * $count; // Which index to start at in the slicing process
                $lengthVal = $indexCat; // how many elements to include from offset in the slice

                $currentSlice = array_slice($ArrayCut, $offsetVal, $indexCat); //Slicing the array up into categoryX+criteriaX,Y,Z..
                $catText = array_shift($currentSlice); // Shifting the category name off the slice into a var

                foreach ($currentSlice as $key => $critText) // For every criteria text left in the slice
                {
                    // Inserting e.g. insertRubricData("Comp Science, PHP, Bad" , "2020-01-19 14:31:08") for each cat/crit pair
                    $handler->insertRubricData("{$rubricName},{$catText},{$critText}", $dateID);
                }
                $count++;
            }
            $view->success = True;
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

$view->pageTitle = 'Rubric Fill';
require_once('Views/adminRubricFill.phtml');
