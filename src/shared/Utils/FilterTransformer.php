<?php

namespace Src\shared\Utils;

use Src\shared\DTOs\FilterDTO;
use Src\shared\FilterType;

class FilterTransformer
{
    public static function transform($filtersKeys, $filtersRequest)
    {
        $filters = [];
        foreach ($filtersRequest as $filterRequest) {
            $key = $filterRequest['key'] ? $filterRequest['key'] : '';
            if (array_key_exists($key, $filtersKeys)) {
                $filter = new FilterDTO();
                $filter->value = $filterRequest['value'] ? $filterRequest['value'] : '';
                $filter->operator = $filterRequest['operator'] ? $filterRequest['operator'] : '';
                $filter->type = $filtersKeys[$key];
                $filter->key = $key;
                $filters[] = $filter;
            }
        }
        return $filters;
    }
}
