<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/UserDataSet.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Add User';

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an ADMIN is logged in
    if (gettype($_SESSION['user']) === 'AdminData'){

        //Checks if admin clicked 'Create User button'
        if(isset($_POST['submit'])){

            //Initiating a connection to database
            $dataSet = new UserDataSet();

            //Checks if admin entered a username that DOES NOT already exists
            if ($dataSet->fetchUser($_POST['userName']) != null){

            }



        }
    }



}


require_once('Views/adminAddUserPage.phtml');