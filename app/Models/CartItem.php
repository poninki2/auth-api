<?php

// app/Models/CartItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'id_cart_item';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user', 'id_product', 'quantity', 'added_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}

