<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsMe;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/p/{post}', [SiteController::class, 'post'])->name('site.post');

Route::get('/note', [SiteController::class, 'note'])->name('site.note');
Route::post('/note', [SiteController::class, 'noteStore'])->name('site.note-store');
Route::get('/pic', [SiteController::class, 'pic'])->name('site.pic');
Route::post('/pic', [SiteController::class, 'picStore'])->name('site.pic-store');

Route::middleware([Authenticate::class, IsMe::class])
    ->post('/note-or-pic-close/{note}', [SiteController::class, 'noteOrPicClose'])->name('site.note-or-pic-close');

Route::get('/figma', [SiteController::class, 'figma'])->name('site.figma');
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
        Route::get('tvpositon', \App\Http\Controllers\Admin\TvSignalController::class)->name('tvsignal');

        Route::resource('post', PostController::class);
        Route::get('post/{post}/delete', [PostController::class,'delete'])->name('post.delete');

        Route::resource('user', UserController::class);
        Route::get('user/{user}/delete', [UserController::class,'delete'])->name('user.delete');
    });

Auth::routes();
