<?php

use App\Http\Controllers\API\CambiarEstadoTrasladoController;
use App\Http\Controllers\API\ConsultarInfoCajasController;
use App\Http\Controllers\API\ConsultarInventarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ConsultarMenuProductosController;
use App\Http\Controllers\API\ConsultarSucursalesInfoController;
use App\Http\Controllers\API\ConsultarTrasladosController;
use App\Http\Controllers\API\ConsultarUsuariosPOSController;
use App\Http\Controllers\API\ConsultarVendedoresController;
use App\Http\Controllers\API\ImportarCortesPendientesController;
use App\Http\Controllers\API\ImportarKardexPendienteController;
use App\Http\Controllers\API\ImportarTransaccionesPendientesController;
use App\Http\Controllers\API\ImportarTrasladosController;
use App\Http\Controllers\TrasladoController;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Broadcast;

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


Route::post('/login', [LoginController::class, 'authenticate'])->name('login-attempt');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {


    // TRASLADOS
    Route::prefix('traslados')->group(function () {
        // Route::post('crear', [TrasladoController::class, 'CrearNuevo']);
        Route::post('finalizar', [CambiarEstadoTrasladoController::class, 'Finalizar']);
        Route::post('rechazar', [CambiarEstadoTrasladoController::class, 'Cancelar']);
        Route::get('consultar_todos', [ConsultarTrasladosController::class, 'ConsultarTodos']);
        Route::get('consultar_enviados_hacia/{claveCentroCosto}/{estado}', [ConsultarTrasladosController::class, 'ConsultarTrasladosHaciaMiSucursal']);
        Route::get('consultar_enviados_desde/{claveCentroCosto}/{estado}', [ConsultarTrasladosController::class, 'ConsultarTrasladosHaciaMiSucursal']);
        Route::get('consultar_ultimos_enviados_hacia/{claveCentroCosto}', [ConsultarTrasladosController::class, 'ConsultarUltimosTrasladosHaciaMiSucursal']);
        Route::get('consultar_ultimos_modificados/{claveCentroCosto}', [ConsultarTrasladosController::class, 'ConsultarUltimosTrasladosModificados']);
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

    // Sucursales
    Route::prefix('sucursales')->group(function () {
        Route::get('consultar_todas', [ConsultarSucursalesInfoController::class, 'ConsultarTodas']);
        Route::get('consultar_info/{codigo}', [ConsultarSucursalesInfoController::class, 'ConsultarInfoSucursal']);
    });

    //cajas
    Route::prefix('cajas')->group(function () {
        Route::get('consultar_info/{codigo}', [ConsultarInfoCajasController::class, 'ConsultarInfoCaja']);
    });

    //vendedores
    Route::prefix('vendedores')->group(function () {
        Route::get('consultar_todos', [ConsultarVendedoresController::class, 'ConsultarTodos']);
    });

    Route::prefix('sync_server')->group(function () {
        Route::post('sync_transacciones_pendientes', [ImportarTransaccionesPendientesController::class, 'Importar']);
        Route::post('sync_kardex_pendientes', [ImportarKardexPendienteController::class, 'Importar']);
        Route::post('sync_cortes_pendientes', [ImportarCortesPendientesController::class, 'Importar']);
        Route::post('sync_traslados_pendientes', [ImportarTrasladosController::class, 'Importar']);
    });
});
