<?php

namespace Scandiweb;

require_once '../src/Scandiweb/Product.php';

class Book extends Product
{
    protected $weight;

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    // Override setData in Book class
    public function setData($data)
    {
        parent::setData($data); // Call the parent class's setData method

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'weight':
                    $this->setWeight($value);
                    break;
                // Add more cases for additional attributes if needed
            }
        }
    }

    public function saveToDatabase()
    {
        $host = 'mysql6008.site4now.net';
        $username = 'a9d850_bdf_1';
        $password = '1405991473029Qi_';
        $databaseName = 'db_a9d850_bdf_1';
        // Assume you have a Database class with a save method
        $database = new Database($host, $username, $password, $databaseName);
        $connection = $database->getConnection();

        // Assuming a table named 'products'
        $stmt = $connection->prepare('INSERT INTO products (sku, name, price, type, weight) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$this->data['sku'], $this->data['name'], $this->data['price'], 'Book', $this->weight]);

        echo 'Saved Book to the database with weight ' . $this->weight . "\n";
    }

}

?>