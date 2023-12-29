<?php

namespace Scandiweb;

require_once '../src/Scandiweb/products/Product.php';

class Electronics extends Product
{
    protected $size;

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    // Override setData in Electronics class
    public function setData($data)
    {
        parent::setData($data); // Call the parent class's setData method

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'size':
                    $this->setSize($value);
                    break;
                // Add more cases for additional attributes if needed
            }
        }
    }

    public function saveToDatabase()
    {
        // $host = 'mysql6008.site4now.net';
        // $username = 'a9d850_bdf_1';
        // $password = '1405991473029Qi_';
        // $databaseName = 'db_a9d850_bdf_1';
        // $database = new Database($host, $username, $password, $databaseName);

        // a Database class with a save method
        $database = new Database();
        $connection = $database->getConnection();

        // a table named 'products'
        $stmt = $connection->prepare('INSERT INTO products (sku, name, price, type, size) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$this->data['sku'], $this->data['name'], $this->data['price'], 'Electronics', $this->size]);

        echo 'Saved Electronics to the database with size ' . $this->size . "\n";
    }

}

?>