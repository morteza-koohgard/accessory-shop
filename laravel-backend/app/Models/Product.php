<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price',
        'discount',
        'thumbnail',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function features()
    {
        return $this->hasMany(ProductFeatureValue::class);
    }
}
