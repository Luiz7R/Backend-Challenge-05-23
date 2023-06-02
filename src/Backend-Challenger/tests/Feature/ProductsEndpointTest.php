<?php

namespace Tests\Feature;

use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsEndpointTest extends TestCase
{
    /**
     * Test if products can be retrieved.
     *
     * @return void
     */
    public function testCanGetProducts()
    {
        $products = Products::factory(10)->create();

        // Fazendo requisição GET para o endpoint de produtos
        $response = $this->withHeaders([
            'accept' => 'application/json',
            'X-API-KEY' => 'nEMcB31cib40Z8lud7bCRemYd25syqjSazrnq3Z6VnqFfhLRaHlxvj8TopTeN5WCo3Iv3Z9fbAVvB7AUEWa2CYluorzuNVAFWxnPlfbrRNm17g6RnxR6ld4K'
          ])->get('/api/products');

          $response->assertJsonFragment([
            "product_name" => $products[0]->product_name,
            "quantity" => $products[0]->quantity,
            "brands" => $products[0]->brands,
          ]);

        $response->assertStatus(200);
    }

    /**
     * Test if a product can be updated.
     *
     * @return void
     */
    public function testCanUpdateProductPutEndpoint()
    {
        $product = Products::factory()->create();

        $updatedProductData = [
            "product_name" => "Chocolate n 3",
            "quantity" => "3",
            "brands" => "Jeff de cacao",
            "categories" => "chocolate,cacao",
            "status" => "published"
        ];

        $response = $this->withHeaders([
            'accept' => 'application/json',
            'X-API-KEY' => 'nEMcB31cib40Z8lud7bCRemYd25syqjSazrnq3Z6VnqFfhLRaHlxvj8TopTeN5WCo3Iv3Z9fbAVvB7AUEWa2CYluorzuNVAFWxnPlfbrRNm17g6RnxR6ld4K'
          ])->put('/api/products/'.$product->code, $updatedProductData);

        $response->assertStatus(200); 
        $this->assertDatabaseHas('products', $updatedProductData);
    }
}
