<?php

namespace App\Repositories;

use App\DTOs\ProductDTO;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use stdClass;

class ProductEloquentORM implements ProductRepositoryInterface
{

    public function __construct(protected Product $model)
    {}

    public function getAll(): array
    {
        return $this->model->paginate(20)->toArray();
    }

    public function findOne(string $code): ?stdClass
    {
        $product = $this->model->where('code', $code)->get();

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
        $this->model->where('code', $code)->firstOrFail()->delete();
    }

    public function update(ProductDTO $dto): ?stdClass
    {
        if(!$product = $this->model->where('code', $dto->code)->first())
        {
            return null;
        }

        $product->update(
            (array) $dto
        );

        return (object) $product->toArray();
    }


}