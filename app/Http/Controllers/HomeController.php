<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq; // Asegúrate de que esta línea esté presente

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio.
     * (Esta ruta es la que está causando el error BadMethodCallException).
     */
    public function index()
    {
        // Esto asumo que es la vista de inicio por defecto de tu aplicación.
        // Si usas el Dashboard como inicio, esto debería redirigir o cargar el welcome.
        return view('welcome'); 
        // Si tu página de inicio es el Dashboard para usuarios logueados:
        // return redirect()->route('dashboard'); 
    }

    /**
     * Muestra la página pública de Preguntas Frecuentes.
     */
    public function preguntasFrecuentes()
    {
        // Este es el código que estábamos agregando
        $faqs = Faq::orderBy('orden', 'asc')->get(); 
        return view('preguntas-frecuentes', compact('faqs'));
    }
}