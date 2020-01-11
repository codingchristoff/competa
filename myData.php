<?php

session_start();

$view = new stdClass();
$view->pageTitle = 'My Data';

require_once('Views/myData.phtml');