<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use stdClass;

class ProductService
{

    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {}

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function findOne(string $code): ?stdClass
    {
        return $this->repository->findOne($code);
    }

    public function store(ProductDTO $dto): stdClass
    {
        return $this->repository->store($dto);
    }

    public function update(ProductDTO $dto): ?stdClass
    {
        return $this->repository->update($dto);
    }

    public function delete(string $code): void
    {
        echo $code;
        $this->repository->delete($code);
    }
}