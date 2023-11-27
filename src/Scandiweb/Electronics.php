<?php

namespace Scandiweb;

require_once '../src/Scandiweb/Product.php';

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
}

?>