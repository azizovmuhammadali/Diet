<?php

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    public function register($userDTO);
    public function login($user);
    public function show($id);
    public function update($id,$user);
    public function delete($id);
    public function loginnumber($userDTO);
}
