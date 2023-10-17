<?php

namespace Src\shared;

class Proveedores
{
    public static $bodega = 'BODEGA';
    public static $institucional = 'INSTITUCIONAL';
    public static $combos = 'COMBOS';
    public static $planta = 'PLANTA';

    public static function getAll(){
        return [
            self::$bodega,
            self::$institucional,
            self::$combos,
            self::$planta
        ];
    }
}