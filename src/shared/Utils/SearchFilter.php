<?php

namespace Src\shared\Utils;

use Src\shared\DTOs\LimiterDTO;
use Src\shared\FilterType;

class SearchFilter
{
    public static function apply($query, $filters = [], $sorters = [])
    {
        foreach ($filters as $key => $filter) {
            $parts = explode('||', $filter->value);
            
            switch ($filter->type) {
                case FilterType::$Date:
                    $dateValue = DateParser::FromJSDateObject($filter->value);
                    $query->whereDate($filter->key, $filter->operator, $dateValue);
                    break;
                case FilterType::$Numeric:
                    $query->where(function ($query) use ($parts, $filter) {
                        foreach ($parts as $part) {
                            $query->orWhere($filter->key, $filter->operator, $part);
                        }
                    });
                    break;
                case FilterType::$Text:
                    $query->where(function ($query) use ($parts, $filter) {
                        foreach ($parts as $part) {
                            $query->orWhere($filter->key, $filter->operator, $part);
                        }
                    });
                break;
            }
        }

        foreach ($sorters as $key => $sorter) {
            switch ($sorter->type) {
                case 'asc':
                    $query->orderBy($sorter->key, 'asc');
                    break;
                case 'desc':
                    $query->orderBy($sorter->key, 'desc');
                    break;
            }
        }

        return $query;
    }
}
