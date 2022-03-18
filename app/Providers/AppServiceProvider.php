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
        Blade::component('components.db-count-in-model', 'db-count-in-model');
        Blade::component('components.test', 'test');

        // TODO подгрузка в шаблон данных (переменная "projectVersion" будет доступна в шаблоне)
        View::composer('layouts.frontend', function ($view) {
            $view->with('appDbCountInModel', \App\Models\Technology::count());
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
        //        Paginator::defaultView('vendor.pagination.bootstrap-v4');
        //        Carbon::setLocale('ru_RU');
    }
}
