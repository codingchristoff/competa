<?php

//on submit
require_once('Models/RubricSet/RubricHandler');

$handler = new RubricHandler();

//Returns complete timestamp on submit and returns dateID
$timestamp = $handler->getTimestamp();
$dateID = $handler->checkDate($timestamp);

$dateID = $handler->checkDate($handler->getTimestamp());

WHile(!array == null)
do -> insertAssessmentValues($string,$dateID);
//NEED METHOD TO EXTRACT VALUES FROM ALI STRING

