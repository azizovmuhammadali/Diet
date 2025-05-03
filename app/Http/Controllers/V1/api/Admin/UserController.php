<?php

namespace App\Http\Controllers\V1\api\Admin;

use App\DTO\UserDTO;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\Services\UserServiceInterface;

class UserController extends Controller
{
    use ResponseTrait;
    public function __construct(protected UserServiceInterface $userServiceInterface){}
    public function register(RegisterRequest $register){
       $userDTO = new UserDTO($register->name,$register->email,$register->password,$register->status);
       $user = $this->userServiceInterface->register($userDTO);
       return $this->success([
        'user' => new UserResource($user['user']),
        'token' => $user['token']
    ], __('successes.user.register'));
    }
    public function login(LoginRequest $loginRequest){
        $data = $loginRequest->validated();
        $response = $this->userServiceInterface->login($data);
        return $this->success([
            'user' => new UserResource($response['user']),
            'token' => $response['token']
        ], __('successes.user.login'));
    
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->success([], __('successes.user.logout'), 204);
    }
}
