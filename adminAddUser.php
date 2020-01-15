<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Add User';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Fetching all of the classes for the drop down menu
$view->allClasses = $dataSet->fetchAllClassNames();

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an ADMIN is logged in
    if ($_SESSION['user']->getRoleID() === '1'){
        //Checks if admin clicked 'Create User button'
        if(isset($_POST['submit'])){
            //Setting the role ID temporarily -> in the UserDataSet this changes
            $_POST['roleID'] = 0;
            //Creating a tempUser to send to the class
            $tempUser = new UserData($_POST);

            $add = $dataSet->createUser($tempUser, $_POST['classID']);
            //Storing the user into the database -> if email is invalid returns false
             if ( $add!== null){

                 //Email is invalid error
                 $view->errorMessage = $add;
             }
             //When creating a user has no problems
             else{
                 //Success message
                 $view->createUserSuccess = 'User successfully created';
             }
        }
    }
    else{
        header('Location: myData.php');
    }
}
else
{
    header('Location: index.php');
}


require_once('Views/adminAddUser.phtml');