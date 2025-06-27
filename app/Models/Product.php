<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name', 'description', 'price', 'original_price', 'image', 'images',
        'category', 'in_stock', 'rating', 'reviews', 'featured', 'tags',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'id_product');
    }

    public function orderItems()
{
    return $this->hasMany(OrderItem::class, 'id_product');
}

}