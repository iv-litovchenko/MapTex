<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsMe;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/tech/{id}', [FrontendController::class, 'tech'])->name('tech');

Route::get('/pics', [FrontendController::class, 'pics'])->name('pics');
Route::get('/books', [FrontendController::class, 'books'])->name('books');
Route::any('/notes', [FrontendController::class, 'notes'])->name('notes');

Route::any('/search', [FrontendController::class, 'search'])->name('search');
Route::any('/login', [FrontendController::class, 'login'])->name('login');
Route::any('/logout', [FrontendController::class, 'logout'])->name('logout');

/**
 * Закрытая часть
 */
Route::middleware([IsMe::class])
    ->namespace('\App\Http\Controllers\Admin\Technologies')
    ->group(function () {

        Route::any('/admin/technologies/create/{parent_id}/{sorting}', 'CreateController')
            ->name('admin.technologies.create');

        Route::any('/admin/technologies/edit/{id}', 'EditController')
            ->name('admin.technologies.edit');

        Route::any('/admin/technologies/edit/sorting/{id}', 'EditSortingController')
            ->name('admin.technologies.edit-sorting');

    });

/**
 * Разное
 */
Route::namespace('\App\Http\Controllers\System')
    ->group(function () {

    });

Auth::routes();
