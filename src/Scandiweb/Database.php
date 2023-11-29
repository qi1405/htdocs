<?php

namespace Scandiweb;

class Database
{
    private $connection;

    public function __construct($host, $username, $password, $databaseName)
    {
        try {
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

    // database-related methods go here...

    // Example method to execute a query
    // public function query($sql)
    // {
    //     return $this->connection->query($sql);
    // }
}

?>