<?php

namespace Src\shared\Parsers;

use DateTime;
use Src\shared\DTOs\KardexDTO;
use Src\shared\PropertyFinder as Prop;

class KardexParser
{
    public static function parse($arr): KardexDTO
    {
        $kardex = new KardexDTO();
        $kardex->codigo = Prop::find('codigo', $arr, '');

        $timestamp = Prop::find('timestamp_creacion', $arr, 0);
        $date = new DateTime();
        $date->setTimestamp($timestamp / 1000);
        $kardex->fecha_hora = $date;

        $kardex->codigo_producto = Prop::find('codigo_producto', $arr, '');
        $kardex->cantidad = Prop::find('cantidad', $arr, 0);
        $kardex->costo = Prop::find('costo', $arr, 0);
        $kardex->precio = Prop::find('precio', $arr, 0);
        $kardex->precio_sin_descuento = Prop::find('precio_sin_descuento', $arr, 0);
        $kardex->tipo_movimiento = Prop::find('tipo_movimiento', $arr, '');
        $kardex->numero_documento = Prop::find('numero_documento', $arr, '');
        $kardex->status = Prop::find('status', $arr, '');
        $kardex->codigo_orden = Prop::find('codigo_orden', $arr, '');
        $kardex->centro_costo = Prop::find('centro_costo', $arr, '');
        $kardex->clave_sucursal = Prop::find('clave_sucursal', $arr, '');
        $kardex->clave_caja = Prop::find('clave_caja', $arr, '');
        $kardex->proveedor_cliente = Prop::find('proveedor_cliente', $arr, '');
        $kardex->tipo_transaccion = Prop::find('tipo_transaccion', $arr, '');
        return $kardex;
    }

    public static function parseManyToArray($arrOfKardex)
    {
        $result = [];

        foreach ($arrOfKardex as $kardexData) {
            $kardexDTO = self::parse($kardexData);
            $result[] = $kardexDTO->toArray();
        }

        return $result;
    }
}
