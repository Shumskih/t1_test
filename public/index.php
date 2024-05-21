<?php

session_start();
require_once '../vendor/autoload.php';
require_once '../routes/routes.php';

//unset($_SESSION[\App\Repository\Favorites\Session::KEY]);
\App\Rmvc\App::run();
