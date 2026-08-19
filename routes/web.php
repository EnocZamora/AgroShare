<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() 
        ? redirect()->route('products.index') 
        : redirect()->route('login');
})->name('home.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products-list', [ProductController::class, 'index'])->name('products.list');

    Route::get('/my-products', [ProductController::class, 'myProducts'])->name('products.my-products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');

    // Sincronizado con el método show() del ProfileController de tu amigo
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'show']); 
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'update']);

    Route::get('/pagos/metodos', [PaymentController::class, 'index'])->name('payments.methods');
    Route::post('/pagos/metodos', [PaymentController::class, 'store'])->name('payments.store');
    
    Route::patch('/chats/{chat}/archive', [ChatController::class, 'toggleArchive'])->name('chats.archive');
    Route::patch('/products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.update-status');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');

    Route::get('/settings/account', function () {
        return view('settings.account');
    })->name('settings.account');

    Route::middleware(['role:admin,auditor'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/audit', [AdminController::class, 'auditLogs'])->name('admin.audit');
    });

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});