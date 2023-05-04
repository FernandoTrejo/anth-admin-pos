<?php

namespace Src\shared\Parsers;

use DateTime;
use Src\shared\DTOs\CorteDTO;
use Src\shared\PropertyFinder as Prop;

class CorteParser
{
    public static function parse($arr): CorteDTO
    {
        $corte = new CorteDTO();

        $corte->codigo = Prop::find('codigo', $arr, '');
        $corte->tipo_corte = Prop::find('tipo_corte', $arr, '');

        $timestampCreacion = Prop::find('timestamp_creacion', $arr, 0);
        $dateCreacion = new DateTime();
        $dateCreacion->setTimestamp($timestampCreacion / 1000);
        $corte->fecha_hora_corte = $dateCreacion;

        $timestampFin = Prop::find('timestamp_fin', $arr, 0);
        $dateFin = new DateTime();
        $dateFin->setTimestamp($timestampFin / 1000);
        $corte->fecha_fin_corte = $dateFin;
        $corte->codigo_caja = Prop::find('codigo_caja', $arr, '');
        $corte->codigo_sucursal = Prop::find('codigo_sucursal', $arr, '');

        $corte->codigo_usuario = Prop::find('usuario_code', $arr, '');
        $corte->montos = Prop::find('montos', $arr, []);

        return $corte;
    }

    public static function parseManyToArray($arrOfCortes)
    {
        $result = [];

        foreach ($arrOfCortes as $corteData) {
            $corteDTO = self::parse($corteData);
            $result[] = $corteDTO->toArray();
        }

        return $result;
    }
}
