<?php

namespace App\DTOs;

use App\Http\Requests\ProductUpdateRequest;
use Carbon\Carbon;

class UpdateProductDTO
{
    public function __construct(
        public ?string $status = null,
        public ?string $imported_t = null,
        public ?string $url = null,
        public ?string $creator = null,
        public ?string $created_t = null,
        public ?string $last_modified_t = null,
        public ?string $product_name = null,
        public ?string $quantity = null,
        public ?string $brands = null,
        public ?string $categories = null,
        public ?string $labels = null,
        public ?string $cities = null,
        public ?string $purchase_places = null,
        public ?string $stores = null,
        public ?string $ingredients_text = null,
        public ?string $traces = null,
        public ?string $serving_size = null,
        public ?string $serving_quantity = null,
        public ?string $nutriscore_score = null,
        public ?string $nutriscore_grade = null,
        public ?string $main_category = null,
        public ?string $image_url = null,
    ) {}

    public static function makeFromRequest(ProductUpdateRequest $request): self
    {
        return new self(
            "published",
            Carbon::now(),
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

    public static function makeFromArray(array $data): self
    {
        $data = self::convertEmptyStringsToNull($data);

        return new self(
            "published",
            Carbon::now(),
            $data['url'],
            $data['creator'],
            $data['created_t'],
            $data['last_modified_t'],
            $data['product_name'],
            $data['quantity'],
            $data['brands'],
            $data['categories'],
            $data['labels'],
            $data['cities'],
            $data['purchase_places'],
            $data['stores'],
            $data['ingredients_text'],
            $data['traces'],
            $data['serving_size'],
            $data['serving_quantity'],
            $data['nutriscore_score'],
            $data['nutriscore_grade'],
            $data['main_category'],
            $data['image_url'],
        );
    }

    private static function convertEmptyStringsToNull(array $data): array
    {
        return array_map(function ($item) {
            return $item === "" ? null : $item;
        }, $data);
    }
}
