<?php

use App\Http\Controllers\VideojuegoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// El route:get nos devuelve una vista que responde a la URL /videojuegos/poseo,
// donde haciendo uso del controlador de Videojuego nos devuelve la funcion poseo()
// con name('videojuegos.poseo') facilitamos la referencia en otras partes del codigo
Route::get('/videojuegos/poseo', [VideojuegoController::class, 'poseo'])->name('videojuegos.poseo');
// Lo mismo pero con una ruta post
Route::post('/videojuegos/poseo', [VideojuegoController::class, 'poseoUpdate'])->name('videojuegos.poseoUpdate');
// El middleware('auth') te manda a loguearte pasando antes por ahi que por la pagina a la que quieres ir
Route::resource('videojuegos', VideojuegoController::class)->middleware('auth');
