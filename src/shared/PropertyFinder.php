<?php

namespace Src\shared;

class PropertyFinder{
    public static function find($clave, $arr, $default){
        if(array_key_exists($clave, $arr)){
            return $arr[$clave];
        }else{
            return $default;
        }
    }
}