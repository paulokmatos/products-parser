<?php

namespace App\Console\Commands;

use App\DTOs\ProductDTO;
use App\Helpers\GzFileProcessor;
use App\Jobs\CreateProduct;
use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class ImportOpenFoodFacts extends Command
{
    protected $signature = 'import:openfoodfacts';
    protected $description = 'Import Open Food Facts data';

    // Define the URLs as class constants
    private const INDEX_URL = 'https://challenges.coode.sh/food/data/json/index.txt';
    private const DATA_URL_BASE = 'https://challenges.coode.sh/food/data/json/';

    public function handle()
    {
        $index = explode("\n", file_get_contents(self::INDEX_URL));

        foreach ($index as $file) {
            $this->importFile($file);
        }

        $this->info('Importação concluída.');
    }

    private function importFile($file)
    {
        $url = self::DATA_URL_BASE . $file;
        $response = Http::get($url);
        $this->info("Downloading file: $file");

        GzFileProcessor::process($response->body(), function($fileContent, $index) {
            $json = json_decode($fileContent, true);

            if(is_null($json)) return;

            $dto = ProductDTO::makeFromArray($json);

            dispatch(new CreateProduct($dto));

            $this->info("$index º Enviado para a Fila");

        }, 100);
    }
}
