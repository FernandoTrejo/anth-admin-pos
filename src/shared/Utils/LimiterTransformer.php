<?php

namespace Src\shared\Utils;

use Src\shared\DTOs\LimiterDTO;

class LimiterTransformer
{
    public static function transform($limiterRequest)
    {
        $limiter = new LimiterDTO();
        $limiter->skip = $limiterRequest['skip'] ? $limiterRequest['skip'] : 0;
        $limiter->take = $limiterRequest['take'] ? $limiterRequest['take'] : 0;
        return $limiter;
    }
}
