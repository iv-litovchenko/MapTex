<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TechController;

Route::get('/',  [HomeController::class, 'index'])
    ->name('home');

Route::get('/tech/{id}',  [HomeController::class, 'tech'])
    ->name('tech');

Route::any('/backend-add/{parent_id}/{sorting}',  [HomeController::class, 'add'])
    ->name('backend-add');

Route::any('/backend-update/{id}',  [HomeController::class, 'update'])
    ->name('backend-update');

Route::any('/backend-update-sorting/{id}',  [HomeController::class, 'updateSorting'])
    ->name('backend-update-sorting');
