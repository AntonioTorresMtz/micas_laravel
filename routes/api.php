<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModelosController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/modelos/obtenerModeloMarca/{id}', [ModelosController::class, 'obtenerModeloMarca']);
Route::middleware('auth:sanctum')->get('/modelos', [ModelosController::class, 'index']);
Route::middleware('auth:sanctum')->get('/modelos/obtenerMicaCompleta/{id}', [ModelosController::class, 'obtenerMicaCompleta']);
Route::middleware('auth:sanctum')->get('/modelos/obtenerMicaNormal/{id}', [ModelosController::class, 'obtenerMicaNormal']);
Route::middleware('auth:sanctum')->get('/marcas', [MarcasController::class, 'index']);
Route::middleware('auth:sanctum')->get('/usuarios', [UsuariosController::class, 'index']);
Route::middleware('auth:sanctum')->delete('/usuarios/{id}', [UsuariosController::class, 'eliminarUsuario']);
Route::middleware('auth:sanctum')->patch('/usuarios/{id}', [UsuariosController::class, 'editarUsuario']);
Route::post('/usuarios/crearUsuario', [UsuariosController::class, 'crearUsuario']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/perfil', [UsuariosController::class, 'perfil']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
