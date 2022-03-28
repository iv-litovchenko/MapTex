<?php

namespace App\Providers;

use Illuminate\Pagination\PaginationState;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // TODO пример компонента
        // Blade::component(\App\View\Components\Mindmap::class, 'mindmap');

        // TODO подгрузка в шаблон данных (переменная "projectVersion" будет доступна в шаблоне)
        View::composer('layouts.default', function ($view) {
            $view->with('appDbCountPosts', \App\Models\Post::count());
            $view->with('appProjectVersion', 1);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO здесь подключаем и перенастраиваем
        // Paginator::defaultView('vendor.pagination.bootstrap-v3');
        Paginator::useBootstrap();

        // TODO установка локали для дат
        Carbon::setLocale('ru_RU');
    }
}
