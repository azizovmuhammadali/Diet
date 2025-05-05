<?php

namespace App\Filters;

class ProductFilter
{
    public function apply($query, $filters)
    {

        if (isset($filters['calory'])) {
            $query->where('calory', $filters['calory']);
        }

        return $query;
    }
}
