<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_product()
    {
        $category = ProductCategory::factory()->create();

        $product = Product::factory()->create([
            'title' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'price' => 99.99,
            'discount' => 10.00,
            'category_id' => $category->id,
            'thumbnail' => 'sample-thumbnail.jpg',
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'price' => 99.99,
            'discount' => 10.00,
            'category_id' => $category->id,
            'thumbnail' => 'sample-thumbnail.jpg',
        ]);
    }

    public function test_it_belongs_to_a_category()
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf(ProductCategory::class, $product->category);
        $this->assertEquals($category->id, $product->category->id);
    }
}
