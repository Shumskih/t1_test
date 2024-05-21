<?php

namespace App\Repository\Favorites;

use Exception;
use App\Server\Session as ServerSession;

class Session implements RepositoryInterface
{
    private ServerSession $session;

    public const string KEY = 'favorites';

    public function __construct(ServerSession $session)
    {
        $this->session = $session;
    }

    public function getAll(): array
    {
        return $this->session->get() ?? [];
    }

    /**
     * @throws Exception
     */
    public function save(int $id, string $name, string $category): bool
    {
        $this->session->add($id, $name, $category);

        return $this->session->getRecordId($id) !== -1;
    }

    public function delete(int $id): void
    {
        $this->session->delete($id);
    }

    public function exists(int $id): bool
    {
        return $this->session->has($id);
    }
}
