<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

    // Relación correcta: un rol puede tener muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol');
    }

    // Constantes para los nombres de roles
    public const ADMIN = 'admin';
    public const CLIENTE = 'cliente';

    // Devuelve un array de roles válidos (si necesitas usarlos en validaciones o formularios)
    public static function roles()
    {
        return [
            self::ADMIN,
            self::CLIENTE,
        ];
    }
}
