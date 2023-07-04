<?php

namespace Src\shared\Utils;

use DateTime;

class DateParser{
    public static $NULL_TIME = 0;
    function __construct()
    {
        
    }

    public static function FromJSDateObject($timestamp){
        if($timestamp === self::$NULL_TIME || $timestamp == null){
            return null;
        }
        $date = new DateTime();
        $date->setTimestamp(($timestamp / 1000));
        return $date;
    }

    public function toArray(){
       
    }
}