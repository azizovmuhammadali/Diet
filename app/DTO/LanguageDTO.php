<?php

namespace App\DTO;

class LanguageDTO
{
    public $name;
    public $prefix;
    public $is_active;
    public function __construct($name, $prefix, $is_active)
    {
        $this->name = $name;
        $this->prefix = $prefix;
        $this->is_active = $is_active;
    }
}