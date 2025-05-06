<?php

namespace App\Interfaces\Reposities;

interface UserReposityInterface
{
    public function registerForm($data);
    public function loginForm($data);
    public function getById($id);
    public function findById($id,$data);
    public function destroy($id);
    public function loginCode($data);
}
