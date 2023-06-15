<?php

namespace App\Repositories\Interfaces;

use App\DTOs\ProductDTO;
use App\DTOs\UpdateProductDTO;
use stdClass;

interface ProductRepositoryInterface
{
    public function getAll(int $limit, int $offset): array;
    public function findOne(string $code): ?stdClass;
    public function store(ProductDTO $dto): stdClass;
    public function update(UpdateProductDTO $dto, string $code): ?stdClass;
    public function delete(string $code): void;
}