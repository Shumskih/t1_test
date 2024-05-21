<?php

namespace App\Repository\Favorites;

use Exception;
use App\Repository\Favorites;
use App\Server\Session as ServerSession;

class Helper
{
    public function getService(): RepositoryInterface
    {
        $type = 'session';

        return match ($type) {
            'file' => new File(),
            'session' => new Favorites\Session(new ServerSession(Session::KEY)),
            default => throw new Exception('Неверный тип сервиса: ' . $type)
        };
    }
}
