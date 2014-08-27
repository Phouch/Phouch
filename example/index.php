<?php
require '../phouch.php';

ini_set("display_errors", 1);
error_reporting(E_ALL);

$config = array(
    "transport" => "http", // https or http
);

$phouch = new Phouch\Phouch($config);

/*
//Add Database
var_dump($phouch->addDatabase("singers"));
*/

/*
//Add Document
$document = new \Phouch\Document();
$document->setDatabase("singers");
$document->setUUID("55555");
$document->setValues(array("name"=>"Don Johnson"));
var_dump($phouch->addDocument($document));
*/

//Get all databases
var_dump($phouch->getAllDatabases());