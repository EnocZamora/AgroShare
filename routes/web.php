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

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
// Ajuste: nombramos la ruta de POST exactamente como probablemente la busca tu vista
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/index', [ProductController::class, 'index'])->name('index');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/my-products', [ProductController::class, 'myProducts'])->name('products.my-products');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Chats
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');

    // Profile
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');

    // Settings
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
    Route::get('/settings/account', function () {
        return view('settings.account');
    })->name('settings.account');

    // Payments
    Route::get('/payments/methods', [PaymentController::class, 'methods'])->name('payments.methods');

    // Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/audit', [AdminController::class, 'audit'])->name('audit');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});