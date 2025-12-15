<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FaqController;

Route::get('/preguntas-frecuentes', [FaqController::class, 'index'])->name('faqs.index');

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto.show');

// Ruta para la Política de Privacidad
Route::get('/politicas-de-privacidad', function () {
    return view('legal.privacidad');
})->name('legal.privacidad');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas (Solo usuarios logueados)
Route::middleware(['auth'])->group(function () {

    // Ruta principal del dashboard
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

    // Rutas CRUD SIN el método index (ya lo definimos arriba)
    Route::resource('dashboard', ProductController::class)
        ->parameters(['dashboard' => 'product']) // Esto corrige el binding
        ->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);

    // --- NUEVA RUTA PARA VERIFICAR SKU ---
    Route::get('/check-sku', [ProductController::class, 'checkSku'])->name('check.sku');
});