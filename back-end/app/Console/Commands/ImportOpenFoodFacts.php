<?php


namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Import;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;

class ImportOpenFoodFacts extends Command
{
    protected $signature = 'import:openfoodfacts';
    protected $description = 'Import Open Food Facts data';

    public function handle()
    {
        // Obtenha a lista de arquivos disponíveis para importação
        $indexUrl = "https://challenges.coode.sh/food/data/json/index.txt";
        $index = explode("\n", file_get_contents($indexUrl));

        // Importe os arquivos
        foreach ($index as $file) {
            $this->importFile($file);
        }

        $this->info('Importação concluída.');
    }

    private function importFile($file)
    {
        // Verifique se o arquivo já foi importado anteriormente
        $existingImport = Import::where('file', $file)->first();
        if ($existingImport) {
            $this->info("O arquivo $file já foi importado. Ignorando...");
            return;
        }

        // Faça o download do arquivo JSON
        $url = "https://challenges.coode.sh/food/data/json/$file";
        $response = Http::get($url);
        $data = $response->json();

        // Importe os produtos do arquivo
        $importedCount = 0;
        foreach ($data as $productData) {
            // Verifique se atingiu o limite de importação por arquivo
            if ($importedCount >= 100) {
                break;
            }

            // Crie uma instância do modelo de produto e preencha os campos
            $product = new Product();
            // Preencha os campos do produto com base nos dados do arquivo
            // ...

            // Defina os campos adicionais
            $product->imported_t = now();
            $product->status = 'published';

            // Valide o produto
            $validator = Validator::make($product->toArray(), [
                // Defina as regras de validação para os campos do produto
                // ...
            ]);

            if ($validator->fails()) {
                $this->info("Produto inválido no arquivo $file. Ignorando...");
                continue;
            }

            // Salve o produto no banco de dados
            $product->save();
            $importedCount++;
        }

        // Registre a importação do arquivo
        Import::create(['file' => $file, 'imported_at' => now()]);
        $this->info("Importação do arquivo $file concluída. Produtos importados: $importedCount");
    }
}
