<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\DTOs\UpdateProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use stdClass;

class ProductService
{

    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {}

    public function getAll(int $limit, int $offset): array
    {
        return $this->repository->getAll($limit, $offset);
    }

    public function findOne(string $code): ?stdClass
    {
        return $this->repository->findOne($code);
    }

    public function store(ProductDTO $dto): stdClass
    {
        return $this->repository->store($dto);
    }

    public function update(UpdateProductDTO $dto, string $code): ?stdClass
    {
        return $this->repository->update($dto, $code);
    }

    public function delete(string $code): void
    {
        $this->repository->delete($code);
    }
}