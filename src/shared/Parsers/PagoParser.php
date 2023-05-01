<?php

namespace Src\shared\Parsers;

use Src\shared\DTOs\PagoDTO;
use Src\shared\PropertyFinder as Prop;

class PagoParser{
    public static function parse($arr) : PagoDTO{
        $pago = new PagoDTO();
        $pago->tipo_pago = Prop::find('tipo_pago', $arr, '');
        $pago->emisor = Prop::find('emisor', $arr, '');
        $pago->recibido = Prop::find('recibido', $arr, 0);
        $pago->codigo_orden = Prop::find('codigo_orden', $arr, '');
        $pago->numero_autorizacion = Prop::find('numero_autorizacion', $arr, 0);
        $pago->numero_telefono = Prop::find('numero_telefono', $arr, '');
        $pago->ultimos_digitos_tarjeta = Prop::find('ultimos_digitos_tarjeta', $arr, '');
        return $pago;
    }

    public static function parseManyToArray($arrOfPayments){
        $result = [];

        foreach($arrOfPayments as $pagoData){
            $pagoDTO = self::parse($pagoData);
            $result[] = $pagoDTO->toArray();
        }

        return $result;
    }
}