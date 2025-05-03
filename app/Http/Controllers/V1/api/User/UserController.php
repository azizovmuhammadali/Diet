<?php

namespace App\Http\Controllers\V1\api\User;

use App\DTO\UserDTO;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\Services\UserServiceInterface;

class UserController extends Controller
{
    use ResponseTrait;
    public function __construct(protected UserServiceInterface $userServiceInterface){}
    public function register(RegisterRequest $register){
        $status = $register->status ?? 'user';
       $userDTO = new UserDTO($register->name,$register->email,$register->password,$status);
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
    public function show($id){
        if (auth()->id() != $id) {
            return $this->error(__('errors.user.user'), 403);
        }
    
        $user = $this->userServiceInterface->show($id);
        return $this->success(new UserResource($user), __('successes.user.show'));
    }
    
    public function update(UserUpdateRequest $userUpdateRequest, $id){
        if (auth()->id() != $id) {
            return $this->error(__('errors.user.user'), 403);
        }
    
        $userDTO = new UserDTO($userUpdateRequest->name,$userUpdateRequest->email,$userUpdateRequest->password,$userUpdateRequest->status);
        $user = $this->userServiceInterface->update($id, $userDTO);
        return $this->success(new UserResource($user), __('successes.user.update'));
    }
    
    public function delete($id){
        if (auth()->id() != $id) {
            return $this->error(__('errors.user.user'), 403);
        }
    
        $this->userServiceInterface->delete($id);
        return $this->success([], __('successes.user.delete'));
    }
    
}
