<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user', 'items', 'total', 'status', 'shipping_address',
        'payment_method', 'estimated_delivery',
    ];

    protected $casts = [
        'items' => 'array',
        'shipping_address' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function items()
{
    return $this->hasMany(OrderItem::class, 'id_order');
}

}