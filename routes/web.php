<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Rutas de Productos
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Rutas de Chats
Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');