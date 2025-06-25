<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'items',
        'total',
        'status',
        'shipping_address',
        'payment_method',
        'estimated_delivery',
    ];

    protected $casts = [
        'items' => 'array',
        'shipping_address' => 'array',
        'estimated_delivery' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}