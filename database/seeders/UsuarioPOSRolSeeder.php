<?php

namespace Database\Seeders;

use App\Models\PermisoUsuarioPOS;
use App\Models\RolUsuarioPOS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioPOSRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //principales roles
        $informatica = RolUsuarioPOS::create(['titulo' => 'informatica']);
        $cajero = RolUsuarioPOS::create(['titulo' => 'cajero']);
        $encargado = RolUsuarioPOS::create(['titulo' => 'encargado']);

        //principales permisos
        $ver_dashboard = PermisoUsuarioPOS::create(['titulo' => 'ver-dashboard']);
        $aperturar_caja = PermisoUsuarioPOS::create(['titulo' => 'aperturar-caja']);
        $ver_ventas = PermisoUsuarioPOS::create(['titulo' => 'ver-ventas']);
        $crear_nueva_venta = PermisoUsuarioPOS::create(['titulo' => 'crear-nueva-venta']);
        $buscar_productos_venta = PermisoUsuarioPOS::create(['titulo' => 'buscar-productos-venta']);
        $aplicar_descuento_global = PermisoUsuarioPOS::create(['titulo' => 'aplicar-descuento-global']);
        $aplicar_descuento_individual = PermisoUsuarioPOS::create(['titulo' => 'aplicar-descuento-individual']);
        $ver_devoluciones = PermisoUsuarioPOS::create(['titulo' => 'ver-devoluciones']);
        $crear_nueva_devolucion = PermisoUsuarioPOS::create(['titulo' => 'crear-nueva-devolucion']);
        $ver_otros_ingresos = PermisoUsuarioPOS::create(['titulo' => 'ver-otros-ingresos']);
        $crear_nuevo_ingreso = PermisoUsuarioPOS::create(['titulo' => 'crear-nuevo-ingreso']);
        $ver_otros_egresos = PermisoUsuarioPOS::create(['titulo' => 'ver-otros-egresos']);
        $crear_nuevo_egreso = PermisoUsuarioPOS::create(['titulo' => 'crear-nuevo-egreso']);
        $ver_anticipos = PermisoUsuarioPOS::create(['titulo' => 'ver-anticipos']);
        $crear_nuevo_anticipo = PermisoUsuarioPOS::create(['titulo' => 'crear-nuevo-anticipo']);
        $ver_productos = PermisoUsuarioPOS::create(['titulo' => 'ver-productos']);
        $ver_traslados = PermisoUsuarioPOS::create(['titulo' => 'ver-traslados']);
        $ver_traslado = PermisoUsuarioPOS::create(['titulo' => 'ver-traslado']);
        $ver_traslados_recibidos = PermisoUsuarioPOS::create(['titulo' => 'ver-traslados-recibidos']);
        $aceptar_traslado_recibido = PermisoUsuarioPOS::create(['titulo' => 'aceptar-traslado-recibido']);
        $cancelar_traslado_recibido = PermisoUsuarioPOS::create(['titulo' => 'cancelar-traslado-recibido']);
        $ver_traslados_enviados = PermisoUsuarioPOS::create(['titulo' => 'ver-traslados-enviados']);
        $cancelar_traslado_enviado = PermisoUsuarioPOS::create(['titulo' => 'cancelar-traslado-enviado']);
        $enviar_nuevo_traslado = PermisoUsuarioPOS::create(['titulo' => 'enviar-nuevo-traslado']);
        $ver_transacciones = PermisoUsuarioPOS::create(['titulo' => 'ver-transacciones']);
        $exportar_transacciones_xlsx = PermisoUsuarioPOS::create(['titulo' => 'exportar-transacciones-xlsx']);
        $ver_transaccion = PermisoUsuarioPOS::create(['titulo' => 'ver-transaccion']);
        $anular_transaccion = PermisoUsuarioPOS::create(['titulo' => 'anular-transaccion']);
        $ver_reportes = PermisoUsuarioPOS::create(['titulo' => 'ver-reportes']);
        $ver_configuraciones = PermisoUsuarioPOS::create(['titulo' => 'ver-configuraciones']);
        $ver_config_numeradores = PermisoUsuarioPOS::create(['titulo' => 'ver-config-numeradores']);
        $editar_config_numeradores = PermisoUsuarioPOS::create(['titulo' => 'editar-config-numeradores']);
        $ver_config_productos = PermisoUsuarioPOS::create(['titulo' => 'ver-config-productos']);
        $editar_config_productos = PermisoUsuarioPOS::create(['titulo' => 'editar-config-productos']);
        $ver_config_formas_pago = PermisoUsuarioPOS::create(['titulo' => 'ver-config-formas-pago']);
        $crear_nueva_forma_pago = PermisoUsuarioPOS::create(['titulo' => 'crear-nueva-forma-pago']);
        $editar_forma_pago = PermisoUsuarioPOS::create(['titulo' => 'editar-forma-pago']);
        $ver_config_impresora = PermisoUsuarioPOS::create(['titulo' => 'ver-config-impresora']);
        $guardar_config_impresora = PermisoUsuarioPOS::create(['titulo' => 'guardar-config-impresora']);
        $ver_config_usuarios = PermisoUsuarioPOS::create(['titulo' => 'ver-config-usuarios']);
        $ver_config_reiniciar_bd = PermisoUsuarioPOS::create(['titulo' => 'ver-config-reiniciar-bd']);
        $ver_config_globales = PermisoUsuarioPOS::create(['titulo' => 'ver-config-globales']);
        $editar_config_globales = PermisoUsuarioPOS::create(['titulo' => 'editar-config-globales']);
        $ver_config_sincronizacion = PermisoUsuarioPOS::create(['titulo' => 'ver-config-sincronizacion']);
        $ver_panel_cortes = PermisoUsuarioPOS::create(['titulo' => 'ver-panel-cortes']);
        $hacer_corte_x = PermisoUsuarioPOS::create(['titulo' => 'hacer-corte-x']);
        $hacer_corte_z = PermisoUsuarioPOS::create(['titulo' => 'hacer-corte-z']);




        //enlazar permisos a roles
        $informatica->permissions()->sync([
            $ver_dashboard->id,
            $aperturar_caja->id,
            $ver_ventas->id,
            $crear_nueva_venta->id,
            $buscar_productos_venta->id,
            $aplicar_descuento_global->id,
            $aplicar_descuento_individual->id,
            $ver_devoluciones->id,
            $crear_nueva_devolucion->id,
            $ver_otros_ingresos->id,
            $crear_nuevo_ingreso->id,
            $ver_otros_egresos->id,
            $crear_nuevo_egreso->id,
            $ver_anticipos->id,
            $crear_nuevo_anticipo->id,
            $ver_productos->id,
            $ver_traslados->id,
            $ver_traslado->id,
            $ver_traslados_recibidos->id,
            $aceptar_traslado_recibido->id,
            $cancelar_traslado_recibido->id,
            $ver_traslados_enviados->id,
            $cancelar_traslado_enviado->id,
            $enviar_nuevo_traslado->id,
            $ver_transacciones->id,
            $exportar_transacciones_xlsx->id,
            $ver_transaccion->id,
            $anular_transaccion->id,
            $ver_reportes->id,
            $ver_configuraciones->id,
            $ver_config_numeradores->id,
            $editar_config_numeradores->id,
            $ver_config_productos->id,
            $editar_config_productos->id,
            $ver_config_formas_pago->id,
            $crear_nueva_forma_pago->id,
            $editar_forma_pago->id,
            $ver_config_impresora->id,
            $guardar_config_impresora->id,
            $ver_config_usuarios->id,
            $ver_config_reiniciar_bd->id,
            $ver_config_globales->id,
            $editar_config_globales->id,
            $ver_config_sincronizacion->id,
            $ver_panel_cortes->id,
            $hacer_corte_x->id,
            $hacer_corte_z->id,
        ]);
        $encargado->permissions()->sync([
            $ver_dashboard->id,
            $aperturar_caja->id,
            $ver_ventas->id,
            $crear_nueva_venta->id,
            $buscar_productos_venta->id,
            $aplicar_descuento_global->id,
            $aplicar_descuento_individual->id,
            $ver_devoluciones->id,
            $crear_nueva_devolucion->id,
            $ver_otros_ingresos->id,
            $crear_nuevo_ingreso->id,
            $ver_otros_egresos->id,
            $crear_nuevo_egreso->id,
            $ver_anticipos->id,
            $crear_nuevo_anticipo->id,
            $ver_productos->id,
            $ver_traslados->id,
            $ver_traslado->id,
            $ver_traslados_recibidos->id,
            $aceptar_traslado_recibido->id,
            $cancelar_traslado_recibido->id,
            $ver_traslados_enviados->id,
            $cancelar_traslado_enviado->id,
            $enviar_nuevo_traslado->id,
            $ver_panel_cortes->id,
            $hacer_corte_x->id,
            $hacer_corte_z->id,
        ]);
        $cajero->permissions()->sync([
            $ver_dashboard->id,
            $aperturar_caja->id,
            $ver_ventas->id,
            $crear_nueva_venta->id,
            $buscar_productos_venta->id,
            $ver_productos->id,
            $ver_panel_cortes->id,
            $hacer_corte_x->id,
            $hacer_corte_z->id,
        ]);
    }
}
