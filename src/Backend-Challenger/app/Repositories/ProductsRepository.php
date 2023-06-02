<?php

namespace App\Repositories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;

class ProductsRepository implements IProductsRepository
{
    public function search (array $queryFiltros) : Collection
    {
        $filtros = array_filter($queryFiltros);
        return Products::when($filtros, function ($query) use ($filtros) {
            foreach ($filtros as $column => $value) {
                if ( is_array($value) ) {
                    $query->whereIn($column, $value);
                } 
                else 
                {
                    $query->where($column, 'like', "%{$value}%");
                }
            }
        })->get();

    }
}