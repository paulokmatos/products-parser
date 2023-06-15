<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'code' => $faker->unique()->randomNumber(9),
            'status' => $faker->randomElement(['published', 'draft']),
            'imported_t' => Carbon::now()->setDays(30),
            'url' => $faker->url,
            'creator' => $faker->name,
            'created_t' => $faker->unixTime,
            'last_modified_t' => $faker->unixTime,
            'product_name' => $faker->sentence,
            'quantity' => (string ) $faker->numberBetween(10, 20000),
            'brands' => $faker->company,
            'categories' => $faker->words(5, true),
            'labels' => $faker->words(3, true),
            'cities' => $faker->city,
            'purchase_places' => $faker->city . ', ' . $faker->country,
            'stores' => $faker->company,
            'ingredients_text' => $faker->text,
            'traces' => $faker->words(5, true),
            'serving_size' => $faker->randomElement(['100g', '200g', '250g']),
            'serving_quantity' => (string) $faker->randomFloat(2, 1, 10),
            'nutriscore_score' => (string) $faker->numberBetween(0, 100),
            'nutriscore_grade' => (string) $faker->randomElement(['A', 'B', 'C', 'D', 'E']),
            'main_category' => $faker->randomElement(['category1', 'category2', 'category3']),
            'image_url' => $faker->imageUrl(),
        ];
    }
}
