<?php

namespace Scandiweb;

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
}

?>