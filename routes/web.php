<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsMe;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;
use DaveJamesMiller\Breadcrumbs\Facades;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/tech/{id}', [FrontendController::class, 'tech'])->name('tech');

Route::any('/notes', [FrontendController::class, 'notes'])->name('notes');
Route::get('/pics', [FrontendController::class, 'pics'])->name('pics');
Route::get('/books', [FrontendController::class, 'books'])->name('books');

Route::any('/search', [FrontendController::class, 'search'])->name('search');
Route::any('/login', [FrontendController::class, 'login'])->name('login');
Route::any('/logout', [FrontendController::class, 'logout'])->name('logout');

//middleware([Authenticate::class, IsMe::class])
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
    Route::resource('technology', \App\Http\Controllers\Admin\TechnologyController::class);
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
});

/**
 * Закрытая часть
 */
Route::middleware([Authenticate::class, IsMe::class])
    ->namespace('\App\Http\Controllers\Admin\Technologies')
    ->group(function () {

        Route::any('/admin/technologies/create/{parent_id}', 'CreateController')
            ->name('admin.technologies.create');

        Route::any('/admin/technologies/edit/{id}', 'EditController')
            ->name('admin.technologies.edit');

        Route::any('/admin/technologies/edit/sorting/{id}', 'EditSortingController')
            ->name('admin.technologies.edit-sorting');

        Route::any('/admin/technologies/edit/parent/{id}', 'EditParentController')
            ->name('admin.technologies.edit-parent');

    });

/**
 * Разное
 */
Route::namespace('\App\Http\Controllers\System')
    ->group(function () {

    });

Auth::routes();
