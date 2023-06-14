<?php

namespace Src\shared\Parsers;

use Src\shared\DTOs\ClienteDTO;
use Src\shared\PropertyFinder as Prop;

class ClienteParser
{
    public static function parse($arr): ClienteDTO
    {
        $cliente = new ClienteDTO();
        $cliente->codigo = Prop::find('codigo', $arr, '');
        $cliente->nombre_cliente = Prop::find('nombre_cliente', $arr, '');
        $cliente->nrc = Prop::find('nrc', $arr, '');
        $cliente->nit = Prop::find('nit', $arr, '');
        $cliente->dui = Prop::find('dui', $arr, '');
        $cliente->direccion = Prop::find('direccion', $arr, '');
        $cliente->actividad_economica = Prop::find('actividad_economica', $arr, '');
        $cliente->tipo_cliente = Prop::find('tipo_cliente', $arr, '');

        return $cliente;
    }
}
