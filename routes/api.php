<?php

use App\Http\Controllers\ActualizarEstadoVentaMovilController;
use App\Http\Controllers\API\Ajustes\CambiarEstadoAjusteController;
use App\Http\Controllers\API\Ajustes\ConsultarAjustesPorStatusController;
use App\Http\Controllers\API\Ajustes\ConsultarAjustesPorTipoController;
use App\Http\Controllers\API\Ajustes\ConsultarAjustesProductosImportacionController;
use App\Http\Controllers\API\Ajustes\ConsultarInfoAjusteController;
use App\Http\Controllers\API\Ajustes\EditarInfoAjusteController;
use App\Http\Controllers\API\Ajustes\FinalizarAjusteController;
use App\Http\Controllers\API\Ajustes\GuardarAjusteController;
use App\Http\Controllers\API\Anticipos\ConsultarAnticipoController;
use App\Http\Controllers\API\Bodega\ConsultarEstadoBodegaController;
use App\Http\Controllers\API\Cajas\ConsultarCajaController;
use App\Http\Controllers\API\Cajas\EditarInfoCreditoFiscalController;
use App\Http\Controllers\API\Cajas\EditarInfoFacturaController;
use App\Http\Controllers\API\Cajas\EditarInfoTicketController;
use App\Http\Controllers\API\CambiarEstadoTrasladoController;
use App\Http\Controllers\API\Clientes\ConsultarClientesController;
use App\Http\Controllers\API\Clientes\ImportarClientesController;
use App\Http\Controllers\API\ConsultarDescuentosProductoController;
use App\Http\Controllers\API\ConsultarInfoCajasController;
use App\Http\Controllers\API\ConsultarInfoEmpresaController;
use App\Http\Controllers\API\ConsultarInventarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ConsultarMenuProductosController;
use App\Http\Controllers\API\ConsultarPreciosProductoController;
use App\Http\Controllers\API\ConsultarProductosContenidosController;
use App\Http\Controllers\API\ConsultarSucursalesInfoController;
use App\Http\Controllers\API\ConsultarTrasladosController;
use App\Http\Controllers\API\ConsultarUsuariosPOSController;
use App\Http\Controllers\API\ConsultarVendedoresController;
use App\Http\Controllers\API\ImportarCortesPendientesController;
use App\Http\Controllers\API\ImportarKardexPendienteController;
use App\Http\Controllers\API\ImportarTransaccionesPendientesController;
use App\Http\Controllers\API\ImportarTrasladosController;
use App\Http\Controllers\API\ConsultarInfoProductoController;
use App\Http\Controllers\API\ConsultarMenuController;
use App\Http\Controllers\API\ConsultarPreciosController;
use App\Http\Controllers\API\ConsultarProductosController;
use App\Http\Controllers\API\EliminarProductoContenidoController;
use App\Http\Controllers\API\GuardarProductoContenidoController;
use App\Http\Controllers\API\ImportarTransformacionesController;
use App\Http\Controllers\API\ImportarTransformacionesProductosController;
use App\Http\Controllers\API\movil\ConsultarVentasMovilesController;
use App\Http\Controllers\API\movil\ImportarVentaMovil;
use App\Http\Controllers\API\RegistrarNuevoUsuarioCajaController;
use App\Http\Controllers\API\Bodega\ConsultarUltimosRegistrosBodegaController;
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
    Route::get('empresa-info', [ConsultarInfoEmpresaController::class, 'Consultar']);

    // USUARIOS
    Route::prefix('usuarios')->group(function () {
        Route::post('registrar_usuario_caja', [RegistrarNuevoUsuarioCajaController::class, 'Registrar']);
        
    });

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

    // TRASLADOS
    Route::prefix('clientes')->group(function () {
        Route::post('importar', [ImportarClientesController::class, 'Importar']);
        Route::get('consultar_todos', [ConsultarClientesController::class, 'Consultar']);
    });

    // INVENTARIO
    Route::prefix('inventario')->group(function () {
        Route::get('consultar_inventario_activo/{skip}/{take}', [ConsultarInventarioController::class, 'ConsultarInventarioActivo']);
        Route::get('consultar_inventario_activo/cantidad', [ConsultarInventarioController::class, 'CantidadInventarioActivo']);
        Route::get('consultar_productos_general', [ConsultarProductosController::class, 'Consultar']);
        Route::get('consultar_productos_ult_mod', [ConsultarProductosController::class, 'UltimosModificados']);
        Route::get('consultar_informacion_producto/{codigo_producto}', [ConsultarInfoProductoController::class, 'Consultar']);
        Route::get('consultar_precios_producto/{codigo_producto}', [ConsultarPreciosProductoController::class, 'Consultar']);
        Route::get('consultar_productos_contenidos/{codigo_producto}', [ConsultarProductosContenidosController::class, 'Consultar']);
        Route::get('consultar_descuentos_producto/{codigo_producto}', [ConsultarDescuentosProductoController::class, 'Consultar']);
        Route::get('consultar_ultimas_existencias/{clave_sucursal}', [ConsultarUltimosRegistrosBodegaController::class, 'ConsultarPorCodigoSucursal']);
        Route::post('consultar_estado_inventario', [ConsultarEstadoBodegaController::class, 'Consultar']);
        Route::post('productos_contenidos/guardar', [GuardarProductoContenidoController::class, 'Guardar']);
        Route::post('productos_contenidos/eliminar', [EliminarProductoContenidoController::class, 'Eliminar']);

        
    });

    Route::prefix('ajustes')->group(function () {
        Route::get('tipo/{tipo_ajuste}/{skip}/{take}', [ConsultarAjustesPorTipoController::class, 'Consultar']);
        Route::get('status/{status_ajuste}/{skip}/{take}', [ConsultarAjustesPorStatusController::class, 'Consultar']);
        Route::get('consultar_info/{id}', [ConsultarInfoAjusteController::class, 'Consultar']);
        Route::post('guardar', [GuardarAjusteController::class, 'Guardar']);
        Route::post('autorizar', [CambiarEstadoAjusteController::class, 'Aceptar']);
        Route::post('rechazar', [CambiarEstadoAjusteController::class, 'Rechazar']);
        Route::post('finalizar', [FinalizarAjusteController::class, 'Finalizar']);
        Route::post('editar', [EditarInfoAjusteController::class, 'Editar']);
        Route::post('consultar_productos_importacion', [ConsultarAjustesProductosImportacionController::class, 'Consultar']);
    });

    Route::prefix('transacciones')->group(function () {
        Route::get('moviles/obtener_sucursal/{codigoSucursal}', [ConsultarVentasMovilesController::class, 'Consultar']);
        Route::post('moviles/importar', [ImportarVentaMovil::class, 'importar']);
        Route::post('moviles/cambiar_estado', [ActualizarEstadoVentaMovilController::class, 'CambiarEstado']);
        // anticipos
        Route::get('anticipos/buscar_numero/{numero}/{skip}/{take}', [ConsultarAnticipoController::class, 'ConsultarPorNumeroTransaccion']);

    });

    // Menu
    Route::prefix('menu')->group(function () {
        Route::get('categorias_productos', [ConsultarMenuProductosController::class, 'Consultar']);
        Route::get('categorias', [ConsultarMenuController::class, 'Consultar']);
        Route::get('precios', [ConsultarPreciosController::class, 'Consultar']);
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
        Route::get('consultar_info_emision/{codigo}', [ConsultarCajaController::class, 'ConsultarCodigo']);
        Route::post('editar_emision_ticket', [EditarInfoTicketController::class, 'Editar']);
        Route::post('editar_emision_factura', [EditarInfoFacturaController::class, 'Editar']);
        Route::post('editar_emision_credito', [EditarInfoCreditoFiscalController::class, 'Editar']);
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
        Route::post('sync_transformations_pendientes', [ImportarTransformacionesProductosController::class, 'Importar']);

        
    });
});
