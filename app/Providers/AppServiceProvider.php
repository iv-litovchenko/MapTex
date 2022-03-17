<?php

namespace App\Providers;

use Illuminate\Pagination\PaginationState;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO Здесь подключаем и перенастраиваем
        Paginator::defaultView('vendor.pagination.bootstrap-v4');
        Carbon::setLocale('ru_RU');
    }
}
