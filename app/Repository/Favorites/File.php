<?php

namespace App\Repository\Favorites;

use App\Exception\NotImplementedException;

class File implements RepositoryInterface
{
    /**
     * @throws NotImplementedException
     */
    public function save(int $id, string $name, string $category): bool
    {
        throw new NotImplementedException();
    }

    /**
     * @throws NotImplementedException
     */
    public function exists(int $id): bool
    {
        throw new NotImplementedException();
    }

    /**
     * @throws NotImplementedException
     */
    public function getAll(): array
    {
        throw new NotImplementedException();
    }
}
