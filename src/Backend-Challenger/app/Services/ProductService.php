<?php

namespace App\Services;

use App\Models\Products;
use App\Repositories\ProductsRepository;

class ProductService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Products();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($code)
    {
        return $this->model->where('code', $code)->get();
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        $product = $this->model->updateOrCreate($attributes, $values);

        // status must be enum with draft, trash e published
        $product ? $product->update(['status' => 'published'])
                 : $product->update(['status' => 'trash']);

        return $product;
    }

    public function update($payload, $id)
    {
        $produto = $this->model->where('code', $id)->first();

        if ( !$produto )
        {
            return false;
        }

        $produto->update($payload);
        
        return $produto;
    }

    public function delete($code)
    {
        $product = $this->model->where('code', $code)->first();

        if ( !$product )
        {
            return false;
        }

        return $product->delete();
    }

    public function search(array $data)
    {
        $productRepository = new ProductsRepository;
        return $productRepository->search($data);
    }
}
