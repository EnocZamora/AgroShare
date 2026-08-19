<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas / Autenticación
|--------------------------------------------------------------------------
*/

// Vista de bienvenida o redirección inicial
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación (Login y Registro)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren iniciar sesión)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // 1. Productos (Mapeo completo de la carpeta products/)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/my-products', [ProductController::class, 'myProducts'])->name('products.my-products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Alias para el índice principal de productos si actúa como dashboard general
    Route::get('/index', [ProductController::class, 'index'])->name('index');

    // 2. Chats (Mapeo de la carpeta chats/)
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');

    // 3. Perfil (Mapeo de la carpeta profile/)
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');

    // 4. Configuración (Mapeo de la carpeta settings/)
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');

    Route::get('/settings/account', function () {
        return view('settings.account');
    })->name('settings.account');

    // 5. Métodos de Pago (Mapeo de la carpeta payments/)
    Route::get('/payments/methods', [PaymentController::class, 'methods'])->name('payments.methods');

    // 6. Panel de Administración (Mapeo de la carpeta admin/)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/audit', [AdminController::class, 'audit'])->name('audit');
    });

    // 7. Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});