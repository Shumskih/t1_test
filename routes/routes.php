<?php

use App\Rmvc\Route\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\CategoriesController;

Route::get('/', [MainController::class, 'index']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/favorites', [FavoritesController::class, 'index']);
Route::post('/favorites', [FavoritesController::class, 'store']);
Route::delete('/favorites/{id}', [FavoritesController::class, 'remove']);
Route::get('/favorites/{post}/', [FavoritesController::class, 'show']);
