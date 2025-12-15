<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        // Agrupamos las preguntas según el rango de 'orden' que definimos en el SQL
        // 10-19: Compra
        // 20-29: Envíos
        // 30-39: Garantía
        
        $bloque_compra   = Faq::where('activo', 1)->whereBetween('orden', [10, 19])->get();
        $bloque_envios   = Faq::where('activo', 1)->whereBetween('orden', [20, 29])->get();
        $bloque_garantia = Faq::where('activo', 1)->whereBetween('orden', [30, 39])->get();

        return view('faqs.index', compact('bloque_compra', 'bloque_envios', 'bloque_garantia'));
    }
}