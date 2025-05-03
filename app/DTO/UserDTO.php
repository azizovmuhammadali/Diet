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
    public function __construct($name,$email,$password,$status)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
    }
}
