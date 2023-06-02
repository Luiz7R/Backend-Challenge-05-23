<?php

namespace Tests\Feature;

use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanCreateProductUnit()
    {
        $productData = [
            "product_name" => "Pate de pamplemousse",
            "quantity" => "Pate",
            "brands" => "Le Pate",
            "categories" => "Pâte pamplemousse",
            "status" => "published"
        ];
    
        $product = Products::create($productData);
    
        $this->assertInstanceOf(Products::class, $product);
        $this->assertDatabaseHas('products', $productData);

        $product->delete(); // for refresh database
    }

    public function testCanUpdateProductUnit()
    {
        $product = Products::factory()->create();

        $newProductData = [
            "product_name" => "Chocolate n 3",
            "quantity" => "3",
            "brands" => "Jeff de cacao",
            "categories" => "chocolate,cacao",
            "status" => "published"
        ];

        $product->update($newProductData);

        $this->assertEquals('Chocolate n 3', $product->product_name);
        $this->assertEquals('Jeff de cacao', $product->brands);

        $product->delete(); // for refresh database
    }
}
