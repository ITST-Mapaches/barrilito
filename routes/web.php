<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedoresController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// !proveedores
// * ruta que muestra la tabla con proveedores
Route::get('/proveedores', [ProveedoresController::class, 'index'])->middleware(['auth'])->name('proveedores');

// * ruta que muestra un formulario para agregar un proveedor
Route::get('/agregarproveedor', [ProveedoresController::class, 'create'])->middleware(['auth'])->name('agregarproveedor');

// * ruta que inserta un proveedor en la base de datos
Route::post('/insertproveedor', [ProveedoresController::class, 'insert'])->middleware(['auth'])->name('insertproveedor');

// * ruta que elimina un proveedor de la base de datos
Route::get('/eliminarproveedor/{proveedor}', [ProveedoresController::class, 'destroy'])->name('eliminarproveedor');

// * ruta que edita un proveedor, obtiene la información de un proveedor y la muestra en un formulario
Route::get('/editarproveedor/{proveedor}', [ProveedoresController::class, 'edit'])->name('editarproveedor');

// * ruta que actualiza un proveedor, al pulsar el boton actualizar, entra en juego esta ruta
Route::post('/actualizarproveedor/{proveedor}', [ProveedoresController::class, 'update'])->name('actualizarproveedor');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';