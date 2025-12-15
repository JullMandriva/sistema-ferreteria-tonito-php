<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'products';

    // Campos que se pueden asignar masivamente (protección de seguridad)
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'codigo_sku',
        'ubicacion',
    ];
}