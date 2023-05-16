<?php

namespace Src\shared\Parsers;

use DateTime;
use DateTimeInterface;
use Src\shared\DTOs\TransaccionDTO;
use Src\shared\PropertyFinder as Prop;

class TransaccionParser{
    public static function parse($arr) : TransaccionDTO{
        $transaccion = new TransaccionDTO();
        $transaccion->codigo = Prop::find('codigo', $arr, '');
        $transaccion->numero_transaccion = Prop::find('numero_transaccion', $arr, '');

        $timestamp = Prop::find('fechaISO', $arr, 0);
        $date = new DateTime();
        $date->setTimestamp($timestamp / 1000);
        $transaccion->fecha = $date;

        $transaccion->nombre_cliente = Prop::find('nombre_cliente', $arr, '');
        $transaccion->total = Prop::find('total', $arr, 0);
        $transaccion->status = Prop::find('status', $arr, '');
        $transaccion->corte_mensual = Prop::find('corte_mensual', $arr, '');
        $transaccion->corte_diario = Prop::find('corte_diario', $arr, '');
        $transaccion->corte_parcial = Prop::find('corte_parcial', $arr, '');
        $transaccion->tipo_documento_clave = Prop::find('tipo_documento_clave', $arr, '');
        $transaccion->forma_pago = Prop::find('forma_pago', $arr, '');
        $transaccion->descripcion = Prop::find('descripcion', $arr, '');
        $transaccion->referencia = Prop::find('referencia', $arr, '');
        $transaccion->codigo_vendedor = Prop::find('codigo_vendedor', $arr, '');
        $transaccion->codigo_caja = Prop::find('codigo_caja', $arr, '');
        $transaccion->codigo_sucursal = Prop::find('codigo_sucursal', $arr, '');
        $transaccion->codigo_usuario = Prop::find('codigo_usuario', $arr, '');
        $transaccion->tipo_transaccion = Prop::find('tipo_transaccion', $arr, '');
        $transaccion->descuento_total = Prop::find('descuento_total', $arr, 0);
        $transaccion->caja_id = Prop::find('caja_id', $arr, 0);
        $transaccion->iva = Prop::find('iva', $arr, 0);
        
        $transaccion->pagos = Prop::find('pagos', $arr, []);
        $transaccion->productos_orden = Prop::find('productos_orden', $arr, []);
        return $transaccion;
    }
}