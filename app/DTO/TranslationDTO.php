<?php

namespace App\DTO;

class TranslationDTO
{
    public $locale;
    public $key;
    public $value;
    public $is_active;
    public function __construct($locale, $key, $value, $is_active)
    {
        $this->locale = $locale;
        $this->key = $key;
        $this->value = $value;
        $this->is_active = $is_active;
    }
}