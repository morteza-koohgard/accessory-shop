<?php

namespace Tests\Unit;

use App\Models\CategoryFeature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ProductCategory;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_category_can_have_a_parent()
    {
        $parent = ProductCategory::factory()->create();
        $child = ProductCategory::factory()->create(['parent_id' => $parent->id]);

        $this->assertEquals($parent->name, $child->parent->name);
    }

    public function test_a_category_can_have_children()
    {
        $parent = ProductCategory::factory()->create();
        $child1 = ProductCategory::factory()->create(['parent_id' => $parent->id]);
        $child2 = ProductCategory::factory()->create(['parent_id' => $parent->id]);

        $this->assertCount(2, $parent->children);
        $this->assertEquals($child1->name, $parent->children[0]->name);
        $this->assertEquals($child2->name, $parent->children[1]->name);
    }

    public function test_is_has_features()
    {
        $category = ProductCategory::factory()->create();
        $feature = CategoryFeature::factory()->create(['category_id' => $category->id]);

        $this->assertCount(1, $category->features);
        $this->assertEquals($feature->name, $category->features[0]->name);
    }
}
