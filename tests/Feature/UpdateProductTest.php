<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class UpdateProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_product_with_valid_data()
    {
        $product = Product::factory()->create();
        $response = $this->putJson('/api/products/' . $product->id, [
            'name' => 'Updated Product Name',
            'description' => 'Updated Product Description',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data'
        ]);
    }

    public function test_update_product_with_invalid_data()
    {
        $product = Product::factory()->create();
        $response = $this->putJson('/api/products/' . $product->id, []);
        $response->assertStatus(200); 
    }
}
