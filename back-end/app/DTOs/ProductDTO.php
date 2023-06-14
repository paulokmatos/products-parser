<?php

namespace App\DTOs;

use App\Http\Requests\ProductStoreRequest;

class ProductDTO
{
    public function __construct(
        public string $code,
        public string $status,
        public string $imported_t,
        public string $url,
        public string $creator,
        public string $created_t,
        public string $last_modified_t,
        public string $product_name,
        public string $quantity,
        public string $brands,
        public string $categories,
        public string $labels,
        public string $cities,
        public string $purchase_places,
        public string $stores,
        public string $ingredients_text,
        public string $traces,
        public string $serving_size,
        public string $serving_quantity,
        public string $nutriscore_score,
        public string $nutriscore_grade,
        public string $main_category,
        public string $image_url,
    ) {}

    public static function makeFromRequest(ProductStoreRequest $request): self
    {
        return new self(
            $request->input('code'),
            $request->input('status'),
            $request->input('imported_t'),
            $request->input('url'),
            $request->input('creator'),
            $request->input('created_t'),
            $request->input('last_modified_t'),
            $request->input('product_name'),
            $request->input('quantity'),
            $request->input('brands'),
            $request->input('categories'),
            $request->input('labels'),
            $request->input('cities'),
            $request->input('purchase_places'),
            $request->input('stores'),
            $request->input('ingredients_text'),
            $request->input('traces'),
            $request->input('serving_size'),
            $request->input('serving_quantity'),
            $request->input('nutriscore_score'),
            $request->input('nutriscore_grade'),
            $request->input('main_category'),
            $request->input('image_url')
        );
    }
}
