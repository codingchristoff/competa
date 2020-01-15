<?php
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/UserDataSet.php');

session_start();

$view = new stdClass();
$view->pageTitle = 'Delete User';

//Initiating a connection to database and giving it to the view
$dataSet = new UserDataSet();
$view->dataSet = $dataSet;

