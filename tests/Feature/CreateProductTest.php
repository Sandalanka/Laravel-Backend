<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
class CreateProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_creation_with_valid_data()
    {
        $productData = Product::factory()->make()->toArray();
        $response = $this->postJson('/api/products', $productData);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                    'id',
                    'name',
                    'description'
            ],
            'message'
        ]);
    }

    public function test_product_creation_with_mssing_fields()
    {
        $response = $this->postJson('/api/products', []);
        $response->assertStatus(200); 
    }
}
