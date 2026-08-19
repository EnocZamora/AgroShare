<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Punto de entrada principal: evalúa la sesión y redirige obligatoriamente al login
Route::get('/', function () {
    return auth()->check() 
        ? redirect()->route('products.index') 
        : redirect()->route('login');
})->name('home.index');

// 2. Rutas Públicas de Huéspedes (Acceso exclusivo sin sesión)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');
});

// 3. Rutas Protegidas (Acceso obligatorio tras iniciar sesión)
Route::middleware(['auth'])->group(function () {

    // Cierre de sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Catálogo general de productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products-list', [ProductController::class, 'index'])->name('products.list');

    // Gestión y creación de publicaciones
    Route::get('/my-products', [ProductController::class, 'myProducts'])->name('products.my-products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Edición, actualización y eliminación de productos
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Módulo de Chats y Mensajería
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');

    // Módulo de Perfil de Usuario
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');

    // Módulo de Métodos de Pago
    Route::get('/pagos/metodos', [PaymentController::class, 'index'])->name('payments.methods');
    Route::post('/pagos/metodos', [PaymentController::class, 'store'])->name('payments.store');
    
    // chat archivados
    Route::patch('/chats/{chat}/archive', [ChatController::class, 'toggleArchive'])->name('chats.archive');

    // Estado producto
    Route::patch('/products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.update-status');

    // Panel de Administración
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Vista de detalle individual (Al final dentro del grupo auth)
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});