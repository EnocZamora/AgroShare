<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Redireccionar raíz al catálogo de productos
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Rutas Públicas de Productos
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    
    // Gestión de Mis Productos (Crear, Editar, Listar propios, Actualizar, Borrar)
    Route::get('/my-products', [ProductController::class, 'myProducts'])->name('products.my-products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Rutas de Chats
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');

    // Panel de Administración y Auditoría
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

});