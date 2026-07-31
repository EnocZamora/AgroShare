<?php

use Illuminate\Support\Facades\Route;

// Ruta Principal
Route::get('/', function () {
    return view('public.home');
})->name('home');

// Autenticación
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    return redirect()->route('home');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    return redirect()->route('home');
});

Route::post('/logout', function () {
    return redirect()->route('home');
})->name('logout');

// Zona de Usuario / Productor
Route::get('/publicacion/crear', function () {
    return view('user.create-publication');
})->name('publication.create');

Route::post('/publicaciones', function () {
    return redirect()->route('home');
})->name('publications.store');

Route::get('/publicacion/{id}', function ($id) {
    $publication = (object)[
        'id' => $id,
        'titulo' => 'Cosecha de Prueba',
        'descripcion' => 'Descripción general de la cosecha agrícola disponible en la zona norte.',
        'precio_unitario' => 1250.00,
        'cantidad_disponible' => 50,
        'ubicacion_finca' => 'Jinotega, Nicaragua',
        'producto' => (object)['nombre' => 'Café']
    ];
    return view('public.publication-detail', compact('publication'));
})->name('publications.show');

Route::post('/publicacion/{id}/contacto', function () {
    return back();
})->name('contacts.store');

Route::get('/negociaciones', function () {
    return view('user.dashboard-producer');
})->name('producer.dashboard');

// Panel de Administración / Auditoría
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard-admin');
})->name('admin.dashboard');