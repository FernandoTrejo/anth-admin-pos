<?php

namespace Src\shared\Parsers;

use Src\shared\DTOs\ProductoContenidoDTO;
use Src\shared\PropertyFinder as Prop;

class ProductoContenidoParser{
    public static function parse($arr) : ProductoContenidoDTO{
        $item = new ProductoContenidoDTO();
        $item->codigo_producto_contenido = Prop::find('codigo_producto_contenido', $arr, '');
        $item->cantidad = Prop::find('cantidad', $arr, 0);
        $item->producto_id = Prop::find('producto_id', $arr, 0);        
        return $item;
    }

    public static function parseManyToArray($arrOfItems){
        $result = [];

        foreach($arrOfItems as $itemData){
            $itemDTO = self::parse($itemData);
            $result[] = $itemDTO->toArray();
        }

        return $result;
    }
}