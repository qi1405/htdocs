<?php

namespace Scandiweb;

require_once '../src/Scandiweb/Product.php';

class Furniture extends Product
{
    protected $width;
    protected $height;
    protected $length;

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    // Override setData in Furniture class
    public function setData($data)
    {
        parent::setData($data); // Call the parent class's setData method

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'width':
                    $this->setWidth($value);
                    break;
                case 'height':
                    $this->setHeight($value);
                    break;
                case 'length':
                    $this->setLength($value);
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
        // a Database class with a save method
        $database = new Database($host, $username, $password, $databaseName);
        $connection = $database->getConnection();

        // a table named 'products'
        $stmt = $connection->prepare('INSERT INTO products (sku, name, price, type, width, height, length) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$this->data['sku'], $this->data['name'], $this->data['price'], 'Furniture', $this->width, $this->height, $this->length]);

        echo 'Saved Furniture to the database with dimensions ' . $this->width . 'x' . $this->height . 'x' . $this->length . "\n";
    }
}

?>