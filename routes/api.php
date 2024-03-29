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
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Bodega\ConsultarBodegaTiempoRealController;
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
use App\Http\Controllers\API\Bodega\FiltrarRegistrosBodegaController;
use App\Http\Controllers\API\Kardex\ConsultarKardexProductoSucursalController;
use App\Http\Controllers\API\Menu\AgregarItemMenuController;
use App\Http\Controllers\API\Menu\ConsultarMenuActivoController;
use App\Http\Controllers\API\Menu\EliminarItemMenuController;
use App\Http\Controllers\API\Productos\BuscarProductosController;
use App\Http\Controllers\API\Productos\ConsultarCombosController;
use App\Http\Controllers\API\Productos\EditarProductoController;
use App\Http\Controllers\API\Productos\GuardarNuevoProductoController;
use App\Http\Controllers\API\Reportes\ConsultarCombosDiaController;
use App\Http\Controllers\API\Reportes\DetallePagosXSucursalController;
use App\Http\Controllers\API\Reportes\DetalleProductosTicketXSucursalController;
use App\Http\Controllers\API\Reportes\TopProductosGlobalController;
use App\Http\Controllers\API\Reportes\TopProductosXSucursalController;
use App\Http\Controllers\API\Reportes\VentaDiariaController;
use App\Http\Controllers\API\Reportes\VentaDiariaProductoSucursalController;
use App\Http\Controllers\API\Reportes\VentasRangoProductosController;
use App\Http\Controllers\API\Reportes\VentasXHoraXSucursalController;
use App\Http\Controllers\API\Reportes\VentasXLineasProductosController;
use App\Http\Controllers\API\Solicitudes\BuscarSolicitudesController;
use App\Http\Controllers\API\Solicitudes\CerrarSolicitudDesdeTiendaController;
use App\Http\Controllers\API\Solicitudes\CrearNuevaSolicitudTiendaController;
use App\Http\Controllers\API\Solicitudes\ModificarStatusSolicitudController;
use App\Http\Controllers\API\Transacciones\ConsultarDetallesTransaccionController;
use App\Http\Controllers\API\Transacciones\ConsultarTransaccionesController;
use App\Http\Controllers\API\Traslados\BuscarTrasladosController;
use App\Http\Controllers\API\Traslados\ConsultarDetallesTrasladosController;
use App\Http\Controllers\API\Traslados\MarcarDesperdicioController;
use App\Http\Controllers\API\Usuarios\AdminPOS\AsignarRolController;
use App\Http\Controllers\API\Usuarios\AdminPOS\ConsultarUsuariosController;
use App\Http\Controllers\API\Usuarios\AdminPOS\EditarDatosUsuarioAdminPosController;
use App\Http\Controllers\API\Usuarios\POS\ActivarUsuarioPOSController;
use App\Http\Controllers\API\Usuarios\POS\AgregarNuevoUsuarioPOSController;
use App\Http\Controllers\API\Usuarios\POS\AsignarRolPOSController;
use App\Http\Controllers\API\Usuarios\POS\ConsultarUsuariosPOSController as POSConsultarUsuariosPOSController;
use App\Http\Controllers\API\Usuarios\POS\DesactivarUsuarioPOSController;
use App\Http\Controllers\API\Usuarios\POS\EditarDatosUsuarioPosController;
use App\Http\Controllers\Temporal\ActualizarDatosFacturaElectronica;

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

Route::post('/register', [AuthController::class, 'register'])->name('register-user');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login-attempt');

//datos factura electronica
Route::post('/datos_fe', [ActualizarDatosFacturaElectronica::class, 'Actualizar']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('change-user-password');
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
        Route::post('busqueda', [BuscarTrasladosController::class, 'Consultar']);
        Route::post('marcar_desperdicio', [MarcarDesperdicioController::class, 'Marcar']);
        Route::get('consultar_todos', [ConsultarTrasladosController::class, 'ConsultarTodos']);
        Route::get('consultar_enviados_hacia/{claveCentroCosto}/{estado}', [ConsultarTrasladosController::class, 'ConsultarTrasladosHaciaMiSucursal']);
        Route::get('consultar_enviados_desde/{claveCentroCosto}/{estado}', [ConsultarTrasladosController::class, 'ConsultarTrasladosHaciaMiSucursal']);
        Route::get('consultar_ultimos_enviados_hacia/{claveCentroCosto}', [ConsultarTrasladosController::class, 'ConsultarUltimosTrasladosHaciaMiSucursal']);
        Route::get('consultar_ultimos_modificados/{claveCentroCosto}', [ConsultarTrasladosController::class, 'ConsultarUltimosTrasladosModificados']);
        Route::get('consultar_detalles/{codigo}', [ConsultarDetallesTrasladosController::class, 'Consultar']);
    });

    Route::prefix('solicitudes_tiendas')->group(function () {
        Route::post('crear', [CrearNuevaSolicitudTiendaController::class, 'Crear']);
        Route::post('busqueda', [BuscarSolicitudesController::class, 'Consultar']);
        Route::post('cerrar_solicitud', [CerrarSolicitudDesdeTiendaController::class, 'Cerrar']);
        Route::post('modificar_status', [ModificarStatusSolicitudController::class, 'Editar']);
        
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
        Route::get('consultar_productos_todos', [ConsultarProductosController::class, 'ConsultarTodos']);
        Route::get('consultar_productos_ult_mod', [ConsultarProductosController::class, 'UltimosModificados']);
        Route::get('consultar_informacion_producto/{codigo_producto}', [ConsultarInfoProductoController::class, 'Consultar']);
        Route::get('consultar_precios_producto/{codigo_producto}', [ConsultarPreciosProductoController::class, 'Consultar']);
        Route::get('consultar_productos_contenidos/{codigo_producto}', [ConsultarProductosContenidosController::class, 'Consultar']);
        Route::get('consultar_descuentos_producto/{codigo_producto}', [ConsultarDescuentosProductoController::class, 'Consultar']);
        Route::get('consultar_ultimas_existencias/{clave_sucursal}', [ConsultarUltimosRegistrosBodegaController::class, 'ConsultarPorCodigoSucursal']);
        Route::post('filtrar_registros_bodega', [FiltrarRegistrosBodegaController::class, 'ConsultarPorCodigoSucursal']);
        
        Route::get('bodega_tiempo_real/{claveSucursal}', [ConsultarBodegaTiempoRealController::class, 'Consultar']);
        Route::get('productos/combos/{skip}/{take}', [ConsultarCombosController::class, 'Consultar']);
        Route::post('productos/busqueda', [BuscarProductosController::class, 'Consultar']);
        Route::post('consultar_estado_inventario', [ConsultarEstadoBodegaController::class, 'Consultar']);
        Route::post('productos_contenidos/guardar', [GuardarProductoContenidoController::class, 'Guardar']);
        Route::post('productos_contenidos/eliminar', [EliminarProductoContenidoController::class, 'Eliminar']);
        Route::post('productos/guardar', [GuardarNuevoProductoController::class, 'Guardar']);
        Route::post('productos/editar', [EditarProductoController::class, 'Guardar']);

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

        //deep search
        Route::post('busqueda', [ConsultarTransaccionesController::class, 'ConsultarTransacciones']);

        Route::get('consultar_detalles/{codigo}', [ConsultarDetallesTransaccionController::class, 'Consultar']);
    });

    // Menu
    Route::prefix('menu')->group(function () {
        Route::get('categorias_productos', [ConsultarMenuProductosController::class, 'Consultar']);
        Route::get('categorias', [ConsultarMenuController::class, 'Consultar']);
        Route::get('precios', [ConsultarPreciosController::class, 'Consultar']);
        
        Route::get('consultar_productos_menu', [ConsultarMenuActivoController::class, 'Consultar']);
        Route::post('agregar_menu_item', [AgregarItemMenuController::class, 'Agregar']);
        Route::post('eliminar_menu_item', [EliminarItemMenuController::class, 'Eliminar']);
    });

    // Usuarios
    Route::prefix('usuarios')->group(function () {
        Route::get('consultar_usuarios', [ConsultarUsuariosPOSController::class, 'Consultar']);
        Route::get('adminpos', [ConsultarUsuariosController::class, 'Consultar']);
        Route::post('adminpos/asignar_rol', [AsignarRolController::class, 'Asignar']);
        Route::post('adminpos/editar', [EditarDatosUsuarioAdminPosController::class, 'Editar']);
        Route::get('pos', [POSConsultarUsuariosPOSController::class, 'Consultar']);
        Route::post('pos/asignar_rol', [AsignarRolPOSController::class, 'Asignar']);
        Route::post('pos/agregar', [AgregarNuevoUsuarioPOSController::class, 'Agregar']);
        Route::get('pos/activar', [ActivarUsuarioPOSController::class, 'Activar']);
        Route::get('pos/desactivar', [DesactivarUsuarioPOSController::class, 'Desactivar']);
        Route::post('pos/editar', [EditarDatosUsuarioPosController::class, 'Editar']);

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

    Route::prefix('reportes')->group(function () {
        Route::post('detalle_productos_ticket', [DetalleProductosTicketXSucursalController::class, 'Consultar']);
        Route::post('detalle_pagos_ticket', [DetallePagosXSucursalController::class, 'Consultar']);
        Route::post('ventas/xhora', [VentasXHoraXSucursalController::class, 'Consultar']);
        Route::post('ventas/diarias', [VentaDiariaController::class, 'Consultar']);
        Route::post('ventas/combos', [ConsultarCombosDiaController::class, 'Consultar']);
        Route::post('ventas/xproducto', [VentaDiariaProductoSucursalController::class, 'Consultar']);
        Route::post('ventas/rango_producto', [VentasRangoProductosController::class, 'Consultar']);
        Route::post('ventas/top_x_sucursal', [TopProductosXSucursalController::class, 'Consultar']);
        Route::post('ventas/top_global', [TopProductosGlobalController::class, 'Consultar']);
        Route::post('ventas/x_linea_producto', [VentasXLineasProductosController::class, 'Consultar']);
    });

    Route::prefix('kardex')->group(function () {
        Route::get('consultar_producto_sucursal/{codigoProducto}/{claveSucursal}/{masRecientes}', [ConsultarKardexProductoSucursalController::class, 'Consultar']);
 
    });

    Route::prefix('sync_server')->group(function () {
        Route::post('sync_transacciones_pendientes', [ImportarTransaccionesPendientesController::class, 'Importar']);
        Route::post('sync_kardex_pendientes', [ImportarKardexPendienteController::class, 'Importar']);
        Route::post('sync_cortes_pendientes', [ImportarCortesPendientesController::class, 'Importar']);
        Route::post('sync_traslados_pendientes', [ImportarTrasladosController::class, 'Importar']);
        Route::post('sync_transformations_pendientes', [ImportarTransformacionesProductosController::class, 'Importar']);

        
    });
});
