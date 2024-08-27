<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'feature_id',
        'value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function feature()
    {
        return $this->belongsTo(CategoryFeature::class, 'feature_id');
    }
}
