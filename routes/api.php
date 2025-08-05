<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CatalogoController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/run-migrations', function () {
    \Artisan::call('migrate', ['--force' => true]);
    \Artisan::call('db:seed', ['--class' => 'CatalogosSeeder', '--force' => true]);

    return response()->json(['status' => 'Migraciones y seeders ejecutados']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [AuthController::class, 'perfil']);
    // Guardar un nuevo libro
    Route::post('/libros', [LibroController::class, 'store']);
    Route::get('/libros', [LibroController::class, 'index']);
    Route::put('/libros/{id}', [LibroController::class, 'update']);
    // Obtener catálogos para dropdowns (géneros, formatos, estados)
    Route::get('/catalogos', [CatalogoController::class, 'index']);
});
