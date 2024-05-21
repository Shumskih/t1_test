<?php

namespace App\Tools;

class Helper
{
    private const int CLEAN_FLAGS = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5;

    public function cleanData(string $data = '')
    {
        if (empty($data)) {
            return '';
        }

        return filter_var(htmlspecialchars(trim($data), self::CLEAN_FLAGS), FILTER_SANITIZE_ADD_SLASHES);
    }
}