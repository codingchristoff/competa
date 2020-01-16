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
    //Checks if an admin is logged in
    if ($_SESSION['user']->getRoleID() === '1')
    {
        //Checks if admin clicked 'Add Class' button
        if(isset($_POST['addClass']))
        {
            $add = $dataSet->addClass($_POST['className']);

            if ( $add!== null){

                //There was a problem creating an error
                $view->errorMessage = $add;
            }
            //When creating a class has no problems
            else{
                //Success message
                $view->createUserSuccess = 'Class successfully created';
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

require_once('Views/adminAddClass.phtml');