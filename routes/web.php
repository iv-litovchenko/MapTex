<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsMe;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/p/{post}', [SiteController::class, 'post'])->name('site.post');
Route::any('/note', [SiteController::class, 'note'])->name('site.note');
Route::get('/pic', [SiteController::class, 'pic'])->name('site.pic');
Route::get('/book', [SiteController::class, 'book'])->name('site.book');
Route::any('/search', [SiteController::class, 'search'])->name('site.search');

Route::middleware([Authenticate::class, IsMe::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
        Route::resource('post', \App\Http\Controllers\Admin\PostController::class);
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::get('quik',
            \App\Http\Controllers\Admin\ApiQuikTradingviewPositionController::class)->name('apiquiktradingviewposition');
    });

/**
 * Закрытая часть
 */
/*
Route::middleware([Authenticate::class, IsMe::class])
    ->namespace('\App\Http\Controllers\Admin\Posts')
    ->group(function () {
        Route::any('/admin/posts/edit/sorting/{id}', 'EditSortingController')
            ->name('admin.posts.edit-sorting');
        Route::any('/admin/posts/edit/parent/{id}', 'EditParentController')
            ->name('admin.posts.edit-parent');

    });
*/

/**
 * Разное
 */
Route::namespace('\App\Http\Controllers\System')
    ->group(function () {

    });

Auth::routes();
