<?php

// Include the autoloader
require_once '../src/Autoloader.php';
require_once '../src/Scandiweb/database/Database.php';
require_once '../src/Scandiweb/API.php';
require_once '../src/Scandiweb/products/Electronics.php';
require_once '../src/Scandiweb/products/Book.php';
require_once '../src/Scandiweb/products/Furniture.php';

// Create an instance of the Database
$database = new Scandiweb\Database();

// Create an instance of the API class
$api = new Scandiweb\API($database);

// Handle the API request
$api->handleRequest();

?>