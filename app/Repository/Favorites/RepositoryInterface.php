<?php

namespace App\Repository\Favorites;

interface RepositoryInterface
{
    public function save(int $id, string $name, string $category): bool;

    public function exists(int $id): bool;

    public function getAll(): array;
}
