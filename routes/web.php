<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsMe;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/technology/{technology}', [SiteController::class, 'technology'])->name('site.technology');
Route::any('/note', [SiteController::class, 'note'])->name('site.note');
Route::get('/pic', [SiteController::class, 'pic'])->name('site.pic');
Route::get('/book', [SiteController::class, 'book'])->name('site.book');
Route::any('/search', [SiteController::class, 'search'])->name('site.search');

//middleware([Authenticate::class, IsMe::class])
Route::middleware([Authenticate::class, IsMe::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
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
