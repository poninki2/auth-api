<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'original_price',
        'image',
        'images',
        'category',
        'in_stock',
        'rating',
        'reviews',
        'featured',
        'tags'
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'in_stock' => 'boolean',
        'featured' => 'boolean'
    ];
}