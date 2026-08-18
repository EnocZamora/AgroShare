<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redireccionar raíz al catálogo de productos
Route::get('/', function () {
    return redirect()->route('products.index');
})->name('home.index');

// Rutas Públicas de Productos
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products-list', [ProductController::class, 'index'])->name('products.list'); // Alias etiquetado según la especificación
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Autenticación y Registro (Rutas Públicas)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    
    // Cierre de sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

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

    // Módulo Perfil y Configuración (Asignación José Rostran)
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');

    // Módulo Gestión de Pagos (Asignación José Rostran)
    Route::get('/pagos/metodos', [PaymentController::class, 'index'])->name('payments.methods');
    Route::post('/pagos/metodos', [PaymentController::class, 'store'])->name('payments.store');

});