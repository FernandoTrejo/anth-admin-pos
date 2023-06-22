<?php

namespace Src\shared\Utils;

use Src\shared\DTOs\SorterDTO;

class SorterTransformer
{
    public static function transform($sortersRequest)
    {
        $sorters = [];
        foreach ($sortersRequest as $sorterValue) {
            $sorter = new SorterDTO();
            $sorter->key = $sorterValue['key'];
            $sorter->type = $sorterValue['type'];
            $sorters[] = $sorter;
        }
        return $sorters;
    }
}
