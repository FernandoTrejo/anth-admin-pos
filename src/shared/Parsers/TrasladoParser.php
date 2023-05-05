<?php

namespace Src\shared\Parsers;

use Src\shared\DTOs\TrasladoDTO;
use Src\shared\PropertyFinder as Prop;
use Src\shared\Utils\DateParser;

class TrasladoParser
{
    public static function parse($arr): TrasladoDTO
    {
        $traslado = new TrasladoDTO();
        $traslado->uuid = Prop::find('codigo', $arr, '');
        $traslado->numero_documento = Prop::find('numero_documento', $arr, '');
        $traslado->codigo_origen = Prop::find('tienda_origen', $arr, '');
        $traslado->codigo_destino = Prop::find('tienda_destino', $arr, '');
        $traslado->centro_costo_origen = Prop::find('centro_costo_origen', $arr, '');
        $traslado->centro_costo_destino = Prop::find('centro_costo_destino', $arr, '');
        $traslado->status = Prop::find('status', $arr, '');
        $traslado->fecha_envio = DateParser::FromJSDateObject(Prop::find('timestamp_envio', $arr, null));
        $traslado->fecha_recepcion_sucursal = DateParser::FromJSDateObject(Prop::find('timestamp_aceptado', $arr, null));
        $traslado->fecha_declinacion_sucursal = DateParser::FromJSDateObject(Prop::find('timestamp_rechazado', $arr, null));

        $traslado->productos = Prop::find('productos', $arr, []);
        return $traslado;
    }

}
