<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsMe;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/tech/{id}', [FrontendController::class, 'tech'])->name('tech');

Route::get('/pics', [FrontendController::class, 'pics'])->name('pics');
Route::get('/books', [FrontendController::class, 'books'])->name('books');
Route::any('/search', [FrontendController::class, 'search'])->name('search');

Route::any('/login', [FrontendController::class, 'login'])->name('login');
Route::any('/logout', [FrontendController::class, 'logout'])->name('logout');

/**
 * Закрытая часть
 */
Route::middleware([IsMe::class])->group(function () {

    Route::any('/backend-add/{parent_id}/{sorting}', [BackendController::class, 'add'])
        ->name('backend-add');

    Route::any('/backend-update/{id}', [BackendController::class, 'update'])
        ->name('backend-update');

    Route::any('/backend-update-sorting/{id}', [BackendController::class, 'updateSorting'])
        ->name('backend-update-sorting');

});
