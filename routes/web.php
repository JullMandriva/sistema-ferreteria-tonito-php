<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\PublicFaqController; 
use App\Http\Controllers\FaqController; // FaqController para el Dashboard

// ----------------------------------------------------
// RUTAS PÚBLICAS
// ----------------------------------------------------

// 1. PÁGINA PRINCIPAL (/)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 2. FAQ PÚBLICO (Cargado dinámicamente desde la DB)
// El controlador dedicado obtiene los datos y los pasa a la vista.
Route::get('/preguntas-frecuentes', [PublicFaqController::class, 'index'])->name('preguntas.frecuentes.public');

// 3. CONTACTO
Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto.show');

// 4. POLÍTICA DE PRIVACIDAD
Route::get('/politicas-de-privacidad', function () {
    return view('legal.privacidad');
})->name('legal.privacidad');

// 5. LOGIN/LOGOUT
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ----------------------------------------------------
// RUTAS PROTEGIDAS (Solo usuarios logueados)
// ----------------------------------------------------
Route::middleware(['auth'])->group(function () {
    
    // 1. RUTAS DE PRODUCTOS (DASHBOARD/CRUD)
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::resource('dashboard', ProductController::class)
        ->parameters(['dashboard' => 'product'])
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/check-sku', [ProductController::class, 'checkSku'])->name('check.sku');

    // 2. RUTAS DE VENTAS (TPV / MÓDULO VENDEDOR)
    Route::controller(CashierController::class)->prefix('ventas')->group(function () {
        Route::get('/', 'index')->name('ventas.index');
        // CORRECCIÓN: Se añade la ruta de búsqueda AJAX para el TPV
        Route::get('/search', 'search')->name('ventas.search'); 
        Route::post('/', 'store')->name('ventas.store');
    });
    
    // 3. RUTAS DE HISTORIAL DE CAMBIOS
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    
    // 4. RUTA INTERNA DE FAQ (para consultas de gestión, si es necesario)
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
});