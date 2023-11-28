<?php

namespace Scandiweb;

class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    public function getSKU()
    {
        return $this->sku;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    // New setData method in the base class

    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;
    }


    // public function setData($data)
    // {
    //     foreach ($data as $key => $value) {
    //         $setterMethod = 'set' . ucfirst($key);
    //         if (method_exists($this, $setterMethod)) {
    //             $this->$setterMethod($value);
    //         }
    //     }
    // }
}
