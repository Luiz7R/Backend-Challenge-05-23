<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IProductsRepository
{
    public function search(array $query): Collection;
}