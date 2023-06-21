<?php

namespace Src\shared\Utils;

use Src\shared\FilterType;

class SearchFilter
{
    public static function apply($query, $filters)
    {
        foreach ($filters as $key => $filter) {
            switch ($filter->type) {
                case FilterType::$Date:
                    $query->whereDate($filter->title, $filter->operator, $filter);
                    break;
                case FilterType::$Numeric:
                    $query->where($filter->title, $filter->operator, $filter);
                    break;
                case FilterType::$Text:
                    $query->where($key, 'like', '%' . $filter->value . '%');
                    break;
            }
        }
        return $query;
    }
}
