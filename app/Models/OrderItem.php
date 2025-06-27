<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order_item';

    protected $fillable = [
        'id_order',
        'id_product',
        'quantity',
        'price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
