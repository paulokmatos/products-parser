<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $numberOfProducts = 1800;

        Product::factory()->count($numberOfProducts)->create();

        $this->command->info("{$numberOfProducts} produtos foram criados com sucesso!");
    }

}
