<?php

namespace App\Repositories;

use App\DTOs\ProductDTO;
use App\DTOs\UpdateProductDTO;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use stdClass;

class ProductEloquentORM implements ProductRepositoryInterface
{

    public function __construct(protected Product $model)
    {}

    public function getAll(int $limit, int $offset): array
    {
        return $this->model
            ->whereNot('status', 'trash')
            ->limit($limit)
            ->offset($offset)
            ->get()
            ->toArray();
    }

    public function findOne(string $code): ?stdClass
    {
        $product = $this->model->where('code', $code)
                                ->whereNot('status', 'trash')
                                ->first();

        if(!$product) return null;

        return (object) $product->toArray();
    }

    public function store(ProductDTO $dto): stdClass
    {
        $product = $this->model->create(
            (array) $dto
        );

        return (object) $product->toArray();
    }

    public function delete(string $code): void
    {
        $this->model->where('code', $code)->update(['status' => 'trash']);
    }

    public function update(UpdateProductDTO $dto, string $code): ?stdClass
    {
        if(!$product = $this->model->where('code', $code)->first())
        {
            return null;
        }

        $dtoWithoutNullValues = array_filter((array) $dto);

        $product->update(
            $dtoWithoutNullValues
        );

        return (object) $product->toArray();
    }


}