<?php

namespace App\Services;

use App\Models\ApiDetails;

class APIDetailsService
{
    private $model;

    public function __construct()
    {
        $this->model = new ApiDetails();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }
}
