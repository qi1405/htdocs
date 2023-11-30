<?php

// Include the autoloader
require_once '../src/Scandiweb/Autoloader.php';
require_once '../src/Scandiweb/Database.php';
require_once '../src/Scandiweb/API.php';
require_once '../src/Scandiweb/Electronics.php';
require_once '../src/Scandiweb/Book.php';
require_once '../src/Scandiweb/Furniture.php';

// Create an instance of the Database
$database = new Scandiweb\Database();

// Create an instance of the API class
$api = new Scandiweb\API($database);

// Handle the API request
$api->handleRequest();

?>