<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Edit User';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

//Fetching all of the classes for the drop down menu
$view->allClasses = $dataSet->fetchAllClassNames();

//Checks if a USER has logged in
if(isset($_SESSION['user']))
{
    //Checks if an admin/teacher is logged in
    if ($_SESSION['user']->getRoleID() === '1' || $_SESSION['user']->getRoleID() === '2')
    {
        //For when a user is searched
        if (isset($_POST['searchUser']))
        {
            $view->user = $dataSet->fetchUser($_POST['userName']);
        }

        //For when a user is edited
        if (isset($_POST['submit']))
        {

            //Setting the role ID temporarily -> in the UserDataSet this changes
            $_POST['roleID'] = 0;
            //Creating a tempUser to send to the class
            $tempUser = new UserData($_POST);

            if ($_SESSION['user']->getRoleID()=='2')
            {
                if($_SESSION['user']->getClassID() == $_POST['classID'] )
                {
                    $edit = $dataSet->editUser($tempUser, $_POST['classID']);
                }
                else
                {
                    $view->errorMessage = 'Can only edit students in class';
                }
            }
            else{
                $edit = $dataSet->editUser($tempUser, $_POST['classID']);

                //Storing the user into the database -> if email is invalid returns false
                if ( $edit!== null){
                    //Email is invalid error
                    $view->errorMessage = $edit;
                }
                //When creating a user has no problems
                else{
                    //Success message
                    $view->editUserSuccess = 'User successfully edited';
                }
            }




            //Fetches the same user
            $view->user = $dataSet->fetchUser($_POST['userName']);
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

require_once('Views/editUser.phtml');