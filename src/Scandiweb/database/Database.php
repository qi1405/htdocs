<?php

namespace Scandiweb;
require_once '../src/Scandiweb/database/Config.php';

class Database
{
    private $connection;

    public function __construct()
    {
        try {
            $host = Config::$dbHost;
            $username = Config::$dbUsername;
            $password = Config::$dbPassword;
            $databaseName = Config::$dbName;

            $this->connection = new \PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Handle connection errors:
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

?>