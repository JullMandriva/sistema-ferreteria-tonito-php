<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCambio extends Model
{
    use HasFactory;

    // Le decimos a Laravel el nombre exacto de la tabla que creaste en Workbench
    protected $table = 'historial_cambios';

    // Permitimos que estos campos se puedan rellenar automáticamente
    protected $fillable = [
        'usuario',
        'accion',
        'producto',
        'detalles',
    ];
}