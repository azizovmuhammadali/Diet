<?php

namespace App\Reposities;

use App\Interfaces\Reposities\UserReposityInterface;
use App\Models\User;

class UserReposity implements UserReposityInterface
{
   public function registerForm($data){
  $user = new User();
  $user->name = $data['name'];
  $user->email = $data['email'];
  $user->password = $data['password'];
  $user->role = $data['status'];
  $user->save();
  $token = $user->createToken('auth_login')->plainTextToken;
  return [
   'user' => $user,
   'token' => $token,
];
   }
   public function loginForm($email){
      return User::where('email', $email)->first();  
  }
  
   public function getById($id){
    $user = User::findOrFail($id);
    return $user;
   }
   public function findById($id, $data){
      $user = User::findOrFail($id);
      $user->name = $data['name'] ?? $user->name;
      $user->email = $data['email'] ?? $user->email;
      $user->password = $data['password'] ?? $user->password;
      $user->save();
      return $user;
   }
   public function destroy($id){
      $user = User::findOrFail($id);
      $user->delete();
   }
   
}
