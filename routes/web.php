<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () { return view('welcome'); });

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    
    // Inicio (Dashboard)
    Route::get('/index', [ProductController::class, 'index'])->name('index');

    // Módulo de PERFIL (carpeta: resources/views/profile/)
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');

    // Módulo de CONFIGURACIÓN (carpeta: resources/views/settings/)
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');

    Route::get('/settings/account', function () {
        return view('settings.account');
    })->name('settings.account');

    // Módulo de CHATS
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');

    // Módulo de PRODUCTOS
    Route::get('/products/my-products', [ProductController::class, 'myProducts'])->name('products.my-products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // RUTA DE CIERRE DE SESIÓN (Fundamental para el botón que añadimos)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});