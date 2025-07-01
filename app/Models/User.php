<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,hasFactory;

    
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'email',
        'password',
        'id_rol',
        'id_person',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relaciones

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_person');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}

