<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Product;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createUser(){
        return  User::factory()->create();
    }

    public function authUser(){
        $user =  $this->createUser();
        Sanctum::actingAs($user);
        return $user;
    }

    public function createProduct(){
        return Product::factory()->create();
    }
}
