<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface {

    public function register(array $data){
        return User::create($data);
    }
    public function login(array $data){
        if(Auth::attempt(['email'=> $data['email'], 'password'=>$data['password']])){
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['status']=true;
            return $success;
        }else{
            return $success['status']=false;

        }
    }
    public function logout(){
        Auth::logout();
    }
}