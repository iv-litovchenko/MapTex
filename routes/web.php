<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsMe;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/p/{post}', [SiteController::class, 'post'])->name('site.post');
Route::get('/note', [SiteController::class, 'note'])->name('site.note');
Route::post('/note', [SiteController::class, 'noteStore'])->name('site.note-store');
Route::get('/pic', [SiteController::class, 'pic'])->name('site.pic');
Route::get('/book', [SiteController::class, 'book'])->name('site.book');
Route::get('/search', [SiteController::class, 'search'])->name('site.search');

/**
 * Закрытая часть
 */
Route::middleware([Authenticate::class, IsMe::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
        Route::resource('post', \App\Http\Controllers\Admin\PostController::class);
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::get('tvpositon', \App\Http\Controllers\Admin\TvPositionController::class)->name('tvposition');
    });

Auth::routes();
