<?php

namespace App\Http\Controllers;

use App\Repositories\ProductsRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ProductsController extends Controller
{

    private $productService;
    protected $elastica;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->productService->all(), 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($code)
    {
        $produto = $this->productService->find($code);

        if ( !count($produto) )
        {
            return response()->json(['error' => 'Produto não encontrado, verique as informações'], 404);
        }

        return response()->json($produto, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $produto = $this->productService->update($request->all(), $id);

        if ( !$produto )
        {
            return response()->json(['error' => 'Produto não encontrado, verique as informações'], 404);
        }

        return response()->json($produto, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($code)
    {
        $delete =  $this->productService->delete($code);

        if ( !$delete )
        {
            return response()->json(['error' => 'ERRO: ao Deletar o Produto, verifique se o mesmo existe'], 404);
        }

        return response()->json(['msg' => 'Produto Deletado com Sucesso'], 200);

    }

    /**
     * Roda o comando: import:openfoodfacts
     * para importar produtos
     *
     */
    public function importarProdutos()
    {
        Artisan::call('import:openfoodfacts');
        
        return response()->json('Sim', 201);
    }

    public function search(Request $request)
    {
        return $this->productService->search($request->all());
    }
}

