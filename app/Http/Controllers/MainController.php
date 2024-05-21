<?php

namespace App\Http\Controllers;

use App\Rmvc\View\View;

class MainController
{
    public function index(): string
    {
        return View::view('posts.index');
    }
}
