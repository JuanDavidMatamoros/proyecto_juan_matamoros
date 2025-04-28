<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard protegido
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil (protegidas por auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Equipos (necesitan estar autenticado)
Route::middleware('auth')->controller(EquipoController::class)->group(function () {
    Route::get('/equipos', 'index')->name('equipos.index');
    Route::get('/equipos/create', 'create')->name('equipos.create');
    Route::post('/equipos', 'store')->name('equipos.store');
    Route::get('/equipos/{id}', 'show')->name('equipos.show')->whereNumber('id');
    Route::get('/equipos/{id}/edit', 'edit')->name('equipos.edit')->whereNumber('id');
    Route::put('/equipos/{id}', 'update')->name('equipos.update')->whereNumber('id');
    Route::delete('/equipos/{id}', 'destroy')->name('equipos.destroy')->whereNumber('id');

    // Extra: ruta para ver jugadores por equipo
    Route::get('/equipos/{id}/jugadores', 'jugadores')->name('equipos.jugadores')->whereNumber('id');
});

// Rutas de Jugadores (necesitan estar autenticado)
Route::middleware('auth')->controller(JugadorController::class)->group(function () {
    Route::get('/jugadores', 'index')->name('jugadores.index');
    Route::get('/jugadores/create', 'create')->name('jugadores.create');
    Route::post('/jugadores', 'store')->name('jugadores.store');
    Route::get('/jugadores/{id}', 'show')->name('jugadores.show')->whereNumber('id');
    Route::get('/jugadores/{id}/edit', 'edit')->name('jugadores.edit')->whereNumber('id');
    Route::put('/jugadores/{id}', 'update')->name('jugadores.update')->whereNumber('id');
    Route::delete('/jugadores/{id}', 'destroy')->name('jugadores.destroy')->whereNumber('id');
});

// Rutas de autenticación (login, register, etc)
require __DIR__.'/auth.php';
