<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra la vista principal (Carousel).
     */
    public function index()
    {
        return view('inicio'); // Carga la vista 'inicio.blade.php'
    }
}