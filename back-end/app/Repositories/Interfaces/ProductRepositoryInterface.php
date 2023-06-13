<?php

namespace App\Repositories\Interfaces;

use App\DTOs\ProductDTO;
use stdClass;

interface ProductRepositoryInterface
{
    public function getAll(): array;
    public function findOne(string $code): ?stdClass;
    public function store(ProductDTO $dto): stdClass;
    public function update(ProductDTO $dto): ?stdClass;
    public function delete(string $code): void;
}