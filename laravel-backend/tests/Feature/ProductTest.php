<?php

namespace Tests\Unit;

use App\Models\CategoryFeature;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFeatureValue;
use App\Models\ProductGallery;
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

    public function test_it_can_have_multiple_galleries()
    {
        $product = Product::factory()->create();
        $galleries = ProductGallery::factory()->count(3)->create(['product_id' => $product->id]);

        $this->assertCount(3, $product->galleries);
        $this->assertInstanceOf(ProductGallery::class, $product->galleries->first());
    }

    public function test_it_can_has_product_feature()
    {
        $product = Product::factory()->create();
        $category_feature = CategoryFeature::factory()->create(['category_id' => $product->category->id, 'type' => 'text']);
        $feature = ProductFeatureValue::create([
            'product_id' => $product->id,
            'feature_id' => $category_feature->id,
            'value' => 'Sample Value',
        ]);

        $this->assertCount(1, $product->features);
        $this->assertInstanceOf(ProductFeatureValue::class, $product->features->first());
    }
}
