<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    public function test_homepage_contains_empty_products_table()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('No products found');
    }

    public function test_homepage_contains_non_empty_products_table()
    {

        $product = Product::create([
            'name' => 'Product 10000',
            'price' => 99.99
        ]);



        $response = $this->get('/');



        $response->assertStatus(200);

        $response->assertDontSee('No products found');

        $view_products = $response->viewData('products');

        $this->assertEquals($product->name, $view_products->first()->name);

    }

}
