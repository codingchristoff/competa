<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Assign Table Group';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an admin/teacher is logged in
    if ($_SESSION['user']->getRoleID() === '1' || $_SESSION['user']->getRoleID() === '2')
    {
        //For when a user is searched
        if (isset($_POST['searchUser']))
        {
            $search = $dataSet->fetchUser($_POST['userName']);
            //Check if the search is a student
            if($search->getRoleID() == '3')
            {
                $view->user = $search;
            }
            else
            {
                $view->user = null;
            }
        }

        //For when a user is assigned a different table group
        if (isset($_POST['setTableGroup']))
        {
           $tableGroup = $dataSet->setTableGroup($_POST['userName'], $_POST['tableGroup']);

           //Check if there was any errors
            if ($tableGroup!==null)
            {
                $view->errorMessage = $tableGroup;
            }
            else
            {
                //Success message
                $view->setTableGroupSuccess = 'Students group updated';
            }
        }
    }
    else
    {
        //If the user is a student they cannot access the page therefore redirect them to myData page
        header('Location: myData.php');
    }

}
else
{
    //If the user is not logged in bring them to the index page
    header('Location: index.php');
}

require_once('Views/assignTableGroup.phtml');