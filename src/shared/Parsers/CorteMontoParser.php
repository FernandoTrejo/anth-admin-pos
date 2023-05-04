<?php

namespace Src\shared\Parsers;

use DateTime;
use Src\shared\DTOs\CorteMontoDTO;
use Src\shared\PropertyFinder as Prop;

class CorteMontoParser
{
    public static function parse($arr): CorteMontoDTO
    {
        $corteMonto = new CorteMontoDTO();


        $corteMonto->codigo_tipo_pago = Prop::find('codigo_tipo_pago', $arr, '');
        $corteMonto->tipo_corte = Prop::find('tipo', $arr, '');
        $corteMonto->tipo_pago = Prop::find('codigo_tipo_pago', $arr, '');
        $corteMonto->monto = Prop::find('monto', $arr, 0);
        $corteMonto->corte_id = Prop::find('corte_id', $arr, 0);


        return $corteMonto;
    }

    public static function parseManyToArray($arrOfCortes)
    {
        $result = [];

        foreach ($arrOfCortes as $corteData) {
            $corteMontoDTO = self::parse($corteData);
            $result[] = $corteMontoDTO->toArray();
        }

        return $result;
    }
}
