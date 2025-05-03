<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Reposities\UserReposityInterface;

class UserService implements UserServiceInterface
{
    public function __construct(protected UserReposityInterface $userReposityInterface){}
    public function register($userDTO){
      $data = [
        'name' => $userDTO->name,
        'email' => $userDTO->email,
        'password' => $userDTO->password,
        'status' => $userDTO->status,
      ];
      return $this->userReposityInterface->registerForm($data);
    }
    public function login($data){
        $user = $this->userReposityInterface->loginForm($data['email']);
        if (Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('auth_login')->plainTextToken;
            return [
                'user' => $user,
                'token' => $token,
            ];
    }
    }
    public function show($id){
     return $this->userReposityInterface->getById($id);
    }
    public function update($id, $user){
      $data = [
        'name' => $user->name ?? null,
        'email' => $user->email ?? null,
        'password' => $user->password ?? null,
        'status' => $user->status ?? null, 
      ];
      return $this->userReposityInterface->findById($id,$data);
    }
    public function delete($id){
      return $this->userReposityInterface->destroy($id);
    }
}
