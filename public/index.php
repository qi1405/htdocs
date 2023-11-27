<?php

// Include the autoloader
require_once '../src/Scandiweb/Autoloader.php';
require_once '../src/Scandiweb/Database.php';
require_once '../src/Scandiweb/API.php';
require_once '../src/Scandiweb/Electronics.php';

        $host = 'localhost';
        $username = 'root';
        $password = '1405991473029Qi_';
        $databaseName = 'product_management';
// Create an instance of the Database class
$database = new Scandiweb\Database($host, $username, $password, $databaseName); // Update with your database credentials

// Create an instance of the API class
$api = new Scandiweb\API($database);

// Handle the API request
$api->handleRequest();

?>