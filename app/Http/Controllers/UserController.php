<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Interfaces\User\UserRepositoryInterface;
use DB;
use App\Classes\ApiCatchErrors;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
class UserController extends BaseController
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function register(RegisterRequest $request){
        DB::beginTransaction();
        $userDetails =[
            'name' =>$request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        try{
            $data =$this->userRepositoryInterface->register($userDetails);
            DB::commit();
            
            return $this->sendResponse(new UserResource($data),'User Register Successful');
        }catch(\Exception $ex){
            return ApiCatchErrors::rollback($ex);
        }
    }
    public function login(LoginRequest $request){
        $userDetails =[
            'email' => $request->email,
            'password' =>$request->password
        ];
        try{
            $data =$this->userRepositoryInterface->login($userDetails);
            if($data['status']){
                return $this->sendResponse($data,"Login Successful");
            }else{
                return $this->sendError("Login Fail");
            }
        
        }catch(\Exception $ex){
            return ApiCatchErrors::throw($ex);
        }
    }

    public function logout(){
        $this->userRepositoryInterface->logout();
        return $this->sendResponse("logout Successful","");

    }
}
