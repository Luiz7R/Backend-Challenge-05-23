<?php

namespace App\Console\Commands;

use App\Services\APIDetailsService;
use App\Services\ProductService;
use Illuminate\Console\Command;

class ImportarOpenFoodFactsDados extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:openfoodfacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar Arquivos de Food Facts data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quantidadeArquivos = 9;
        $quantidadeProdutos = 100;
        $ApiDetailsService = new APIDetailsService();

        $iniciarTempo = microtime(true);

        for ( $i = 1; $i <= $quantidadeArquivos; $i++ )
        {
            $arquivoCompactado = 'https://challenges.coode.sh/food/data/json/products_0'.$i.'.json.gz';
            $destinoArquivo = 'products_0'.$i.'.json';

            $dadosArquivo = file_get_contents($arquivoCompactado);

            file_put_contents($destinoArquivo . '.gz', $dadosArquivo);

            $ponteiroGZ = gzopen($destinoArquivo . '.gz', 'rb');
            $produtosJson = [];

            for ( $i = 0; $i < $quantidadeProdutos; $i++ ) 
            {
                $linha = gzgets($ponteiroGZ);

                if ( $linha == false )
                {
                    break;
                }
                
                array_push($produtosJson, $linha);
            }

            gzclose($ponteiroGZ);
            unlink($destinoArquivo . '.gz');

            $produtosJson = str_replace('"\\', '', $produtosJson);
        }
        
        $detalhes = $this->updateOrCreateProducts($produtosJson);
        $fimTempoExecucao = microtime(true);
        $tempoExecucao = $fimTempoExecucao - $iniciarTempo;

        $detalhes['tempo_execucao'] = $tempoExecucao;
        
        $ApiDetailsService->store($detalhes);

        return Command::SUCCESS;
    }

    public function updateOrCreateProducts(array $produtosJson)
    {
        $productService = new ProductService();
        $statusImportacao = 'Importação iniciada';

        foreach( $produtosJson as $produto )
        {
            $produtoSalvo = $productService->updateOrCreate($this->apenasRequisitados(json_decode($produto, true)));
            $statusImportacao = $produtoSalvo ? 'Importação: Realizada com Sucesso!' 
            : 'Importação: Falhou, verifique os Logs!';
        }        $memoryConsumed = round(memory_get_usage() / 1024) . 'KB';

        $detalhes = [
            'memoria_consumida' => $memoryConsumed,
            'status' => $statusImportacao,
            'data_importação' => now()->format('Y-m-d H:i:s')
        ];

        return $detalhes;

    }

    public function apenasRequisitados(array $produto)
    {

        return [
            'code' => $produto['code'],
            'imported_t' => now()->format('Y-m-d H:i:s'),
            'url' => $produto['url'],
            'product_name' => $produto['product_name'],
            'quantity' => $produto['quantity'],
            'brands' => $produto['brands'],
            'categories' => $produto['categories'],
            'labels' => $produto['labels'],
            'cities' => $produto['cities'],
            'stores' => $produto['stores'],
            'purchase_places' => $produto['purchase_places'],
            'ingredients_text' => $produto['ingredients_text'],
            'traces' => $produto['traces'],
            'serving_size' => $produto['serving_size'],
            'serving_quantity' => $produto['serving_quantity'],
            'nutriscore_score' => $produto['nutriscore_score'],
            'nutriscore_grade' => $produto['nutriscore_grade'],
            'main_category' => $produto['main_category'],
            'image_url' => $produto['image_url'],
        ];
    }
}
