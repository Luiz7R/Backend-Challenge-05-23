<?php

namespace App\Http\Controllers;

use App\Models\ApiDetails;
use Illuminate\Support\Facades\DB;

class ApiDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        try {
            $ultimoEscritaDB = ApiDetails::latest()->get();

            return response()->json([
                'success' => 'Conexão, leitura e Escritura com a Base de Dados Está Sem problemas',
                'ultimoExecucaoCron' => $ultimoEscritaDB
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'ERRO: Ao conectar com o banco de dados, verifique com o suporte',
                'errorMsg' => $e->getMessage()
            ], 400);
        }

    }

}
