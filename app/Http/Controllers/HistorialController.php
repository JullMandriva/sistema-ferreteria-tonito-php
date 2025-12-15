<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialCambio;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Solo Admin y Almacenero pueden ver el historial
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            if (!$user->isAdmin() && !$user->isAlmacenero()) {
                return redirect()->route('dashboard')->with('error', 'Acceso denegado. Solo Administradores y Almaceneros pueden acceder al historial.');
            }

            return $next($request);
        });
    }

    /**
     * Muestra la lista paginada del historial de cambios.
     */
    public function index()
    {
        // Cargar el historial ordenado por el más reciente (descendente)
        $historial = HistorialCambio::orderBy('created_at', 'desc')->paginate(15);

        return view('historial.index', compact('historial'));
    }
}