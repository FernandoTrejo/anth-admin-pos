<?php

namespace Src\shared\Utils;

use Src\shared\DTOs\FilterDTO;
use Src\shared\FilterType;
use Src\shared\PropertyFinder;

class FilterTransformer
{
    public static function transform($filtersKeys, $filtersRequest)
    {
        $filters = [];
        foreach ($filtersRequest as $filterRequest) {
            $key = PropertyFinder::find('key', $filterRequest, ''); 
            if (array_key_exists($key, $filtersKeys)) {
                $filter = new FilterDTO();
                $filter->value = PropertyFinder::find('value', $filterRequest, '');
                $filter->operator = PropertyFinder::find('operator', $filterRequest, '');
                $filter->type = $filtersKeys[$key];
                $filter->key = $key;
                $filters[] = $filter;
            }
        }
        return $filters;
    }
}
