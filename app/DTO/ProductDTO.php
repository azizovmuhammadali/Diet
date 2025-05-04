<?php

namespace App\DTO;

class ProductDTO
{
    /**
     * Create a new class instance.
     */
    public $translations;
    public $image;
    public $calory;
    public function __construct($translations,$image,$calory)
    {
        $this->translations = $translations;
        $this->image = $image;
        $this->calory = $calory;
    }
}
