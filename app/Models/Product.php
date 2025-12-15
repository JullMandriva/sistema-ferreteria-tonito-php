<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // AHORA APUNTA A LA TABLA CORRECTA
    protected $table = 'productos'; // <-- ¡CORRECCIÓN CLAVE!

    // Campos que se pueden asignar masivamente (protección de seguridad)
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'codigo_sku',
        'ubicacion',
        'imagen'
    ];
}