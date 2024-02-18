<?php

namespace App\Interfaces\User;


interface UserRepositoryInterface{

    public function register(array $data);
    public function login(array $data);
    public function logout();

}