<?php

namespace App\Server;

class Session
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function get(): mixed
    {
        return $_SESSION[$this->key];
    }

    public function add(int $id, string $name, string $category): void
    {
        $_SESSION[$this->key][] = ['id' => $id, 'title' => $name, 'category' => $category];
    }

    public function delete(int $id): void
    {
        $recordId = $this->getRecordId($id);

        if ($recordId === -1) {
            return;
        }

        unset($_SESSION[$this->key][$recordId]);
    }

    public function has(int $id): bool
    {
        $recordId = $this->getRecordId($id);

        return $recordId !== -1;
    }

    public function getRecordId(int $id): int
    {
        if (!isset($_SESSION[$this->key])) {
            return -1;
        }

        foreach ($_SESSION[$this->key] as $key => $item) {
            if ((int)$item['id'] === $id) {
                return $key;
            }
        }

        return -1;
    }
}
