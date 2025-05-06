<?php

namespace App\DTO;

class UserDTO
{
    /**
     * Create a new class instance.
     */
    public $name;
    public $email;
    public $password;
    public $status;
    public $number;
    public function __construct($name,$email,$password,$status,$number)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->number = $number;
    }
}
