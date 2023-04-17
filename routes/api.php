<?php

use App\Http\Controllers\API\CambiarEstadoTrasladoController;
use App\Http\Controllers\API\ConsultarInventarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ConsultarMenuProductosController;
use App\Http\Controllers\API\ConsultarUsuariosPOSController;
use App\Http\Controllers\TrasladoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'authenticate'])->name('login-attempt');

// TRASLADOS
Route::prefix('traslados')->group(function () {
    Route::post('crear', [TrasladoController::class, 'CrearNuevo']);
    Route::post('finalizar', [CambiarEstadoTrasladoController::class, 'Finalizar']);
    Route::post('cancelar', [CambiarEstadoTrasladoController::class, 'Cancelar']);
});

// INVENTARIO
Route::prefix('inventario')->group(function () {
    Route::get('consultar_inventario_activo/{skip}/{take}', [ConsultarInventarioController::class, 'ConsultarInventarioActivo']);
    Route::get('consultar_inventario_activo/cantidad', [ConsultarInventarioController::class, 'CantidadInventarioActivo']);
});

// Menu
Route::prefix('menu')->group(function () {
    Route::get('categorias_productos', [ConsultarMenuProductosController::class, 'Consultar']);
});

// Usuarios
Route::prefix('usuarios')->group(function () {
    Route::get('consultar_usuarios', [ConsultarUsuariosPOSController::class, 'Consultar']);
});

