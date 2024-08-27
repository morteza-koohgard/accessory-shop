<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'feature_id',
        'name',
        'type',
        'options',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function featureValue()
    {
        return $this->hasMany(ProductFeatureValue::class, 'feature_id');
    }
}
