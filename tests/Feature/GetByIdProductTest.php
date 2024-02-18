<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class GetByIdProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_get_by_id()
    {
        $product = Product::factory()->create();
        $response = $this->getJson('/api/products/' . $product->id);
        $response->assertStatus(200); 
        $response->assertJsonStructure([
            'success',
            'data' => [
                    'id',
                    'name',
                    'description'
            ],
        ]);
    }
}
