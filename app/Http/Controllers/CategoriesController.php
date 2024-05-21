<?php

namespace App\Http\Controllers;

use App\Rmvc\View\View;

class CategoriesController
{
    public function index(): string
    {
        return View::view('posts.index');
    }
}
