<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    // Esto le dice a Laravel: "Esta clase controla la tabla 'faqs'"
    protected $table = 'faqs'; 
    
    // Estos son los campos que permitimos llenar
    protected $fillable = ['pregunta', 'respuesta', 'activo', 'orden'];
}