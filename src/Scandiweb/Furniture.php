<?php

namespace Scandiweb;

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
}

?>