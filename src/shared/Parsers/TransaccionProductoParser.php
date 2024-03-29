<?php

namespace Src\shared\Parsers;

use Src\shared\DTOs\TransaccionProductoDTO;
use Src\shared\PropertyFinder as Prop;

class TransaccionProductoParser{
    public static function parse($arr) : TransaccionProductoDTO{
        $transaccionProducto = new TransaccionProductoDTO();
        $transaccionProducto->codigo_producto = Prop::find('codigo_producto', $arr, '');
        $transaccionProducto->nombre_producto = Prop::find('nombre_producto', $arr, '');
        $transaccionProducto->precio = Prop::find('precio', $arr, 0);
        $transaccionProducto->costo = Prop::find('costo', $arr, 0);
        $transaccionProducto->cantidad = Prop::find('cantidad', $arr, 0);
        $transaccionProducto->subtotal = Prop::find('subtotal', $arr, 0);
        $transaccionProducto->porcentaje_descuento = Prop::find('porcentaje_descuento', $arr, 0);
        $transaccionProducto->valor_descuento = Prop::find('valor_descuento', $arr, 0);
        $transaccionProducto->precio_sin_descuento = Prop::find('precio_sin_descuento', $arr, 0);
        $transaccionProducto->codigo_orden = Prop::find('codigo_orden', $arr, '');
        $transaccionProducto->codigo_corte_x = Prop::find('codigo_corte_x', $arr, '');
        $transaccionProducto->iva = Prop::find('iva', $arr, 0);
        $transaccionProducto->motivo_descuento = Prop::find('motivo_descuento', $arr, '');
        $transaccionProducto->codigo_encargo = Prop::find('codigo_encargo', $arr, null);
        return $transaccionProducto;
    }

    public static function parseManyToArray($arrOfProducts){
        $result = [];

        foreach($arrOfProducts as $transaccionProductoData){
            $transaccionProductoDTO = self::parse($transaccionProductoData);
            $result[] = $transaccionProductoDTO->toArray();
        }

        return $result;
    }
}