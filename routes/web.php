<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DocController;
use App\Http\Controllers\Admin\TodoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsMe;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Litovchenko\MigrationAssistant\App;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

// class DeploymentController extends Controller
// public function deploy() { }
Route::match(['get', 'post'], '/deploy', function () {
    Config::set('app.debug', true); // deploy
    Config::set('app.env', 'local');
    $scriptPath = base_path('.bash/deploy-cicd.sh');
    $process = new Process(['sh', $scriptPath], base_path());
    $process->run(null, [   //  Adjust to the php-fpm version installed
        'PHP_PATH' => getenv('DEPLOY_PHP_PATH', 'php'),
        'BRANCH' => getenv('DEPLOY_GIT_BRANCH', 'master')
    ]);

    //  Let's check if the script was executed successfully
    if (!$process->isSuccessful()) {

        //  If the execution failed, let's throw the error
        throw new ProcessFailedException($process);
    }

    //  Otherwise let's return the output response
    return nl2br($process->getOutput());
})->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('deploy');

Route::get('/liapp', function () {
    $liApp = new App();
    return $liApp->main();
});

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/sitemap', [SiteController::class, 'sitemap'])->name('site.sitemap');
Route::get('/p/{post}', [SiteController::class, 'post'])->name('site.post');
Route::post('/p/{post}', [SiteController::class, 'postNoteStore'])->name('site.post-store');

Route::get('/note', [SiteController::class, 'note'])->name('site.note');
Route::post('/note', [SiteController::class, 'noteStore'])->name('site.note-store');
Route::get('/pic', [SiteController::class, 'pic'])->name('site.pic');
Route::post('/pic', [SiteController::class, 'picStore'])->name('site.pic-store');

Route::middleware([Authenticate::class, IsMe::class])
    ->post('/note-or-pic-close/{note}', [SiteController::class, 'noteOrPicClose'])->name('site.note-or-pic-close');

Route::get('/figma', [SiteController::class, 'figma'])->name('site.figma');
Route::get('/book', [SiteController::class, 'book'])->name('site.book');
Route::post('/book', [SiteController::class, 'bookStore'])->name('site.book-store');

Route::get('/doc', [SiteController::class, 'doc'])->name('site.doc');
Route::post('/doc', [SiteController::class, 'docStore'])->name('site.doc-store');
Route::get('/doc/{cat}', [SiteController::class, 'doc'])->name('site.doc-cat');

Route::get('/project', [SiteController::class, 'project'])->name('site.project');
Route::get('/technology', [SiteController::class, 'technology'])->name('site.technology');

/**
 * Закрытая часть
 */
Route::middleware([Authenticate::class, IsMe::class])
    ->group(function () {
        Route::get('/doc/download/{doc}', [SiteController::class, 'docDownload'])->name('site.doc-download');
    });

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
        Route::get('backup', \App\Http\Controllers\Admin\BackupController::class)->name('backup');

        Route::resource('post', PostController::class);
        Route::get('post/{post}/delete', [PostController::class, 'delete'])->name('post.delete');

        Route::get('post/{post}/edit/parent', [PostController::class, 'editParent'])->name('post.edit-parent');
        Route::put('post/{post}/edit/parent', [PostController::class, 'updateParent'])->name('post.update-parent');

        Route::get('post/{post}/edit/sorting', [PostController::class, 'editSorting'])->name('post.edit-sorting');
        Route::put('post/{post}/edit/sorting', [PostController::class, 'updateSorting'])->name('post.update-sorting');

        Route::resource('user', UserController::class);
        Route::get('user/{user}/delete', [UserController::class, 'delete'])->name('user.delete');

        Route::resource('todo', TodoController::class);

        Route::get('doc/{doc}/edit', [DocController::class, 'edit'])->name('doc.edit');
        Route::put('doc/{doc}/edit', [DocController::class, 'update'])->name('doc.update');

        Route::get('doc/{doc}/delete', [DocController::class, 'delete'])->name('doc.delete');
        Route::put('doc/{doc}/delete', [DocController::class, 'destroy'])->name('doc.destroy');
    });

Auth::routes();
