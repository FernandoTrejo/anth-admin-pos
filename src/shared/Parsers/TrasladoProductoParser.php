<?php

namespace Src\shared\Parsers;

use Src\shared\DTOs\TrasladoProductoDTO;
use Src\shared\PropertyFinder as Prop;

class TrasladoProductoParser{
    public static function parse($arr) : TrasladoProductoDTO{
        $trasladoProducto = new TrasladoProductoDTO();
        $trasladoProducto->codigo_producto = Prop::find('codigo_producto', $arr, '');
        $trasladoProducto->cantidad = Prop::find('cantidad', $arr, 0);
        $trasladoProducto->costo = Prop::find('costo', $arr, 0);
        $trasladoProducto->linea = Prop::find('linea', $arr, '');
        $trasladoProducto->traslado_id = Prop::find('traslado_id', $arr, null);
        return $trasladoProducto;
    }

    public static function parseManyToArray($arrOfProducts){
        $result = [];

        foreach($arrOfProducts as $trasladoProductoData){
            $trasladoProductoDTO = self::parse($trasladoProductoData);
            $result[] = $trasladoProductoDTO->toArray();
        }

        return $result;
    }
}