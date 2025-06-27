<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model {
    use HasFactory;

    protected $primaryKey = 'id_person';

    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'address',
        'phone',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id_person');
    }
}

