<?php

namespace App\DTO;

class OrderDTO
{
    /**
     * Create a new class instance.
     */
    public $product_id;
    public $quantity;
    public $max_calory;

    public function __construct($product_id,$quantity,$max_calory)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->max_calory = $max_calory;
    }
}
