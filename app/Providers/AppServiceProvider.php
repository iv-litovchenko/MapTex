<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Blade::component(\App\View\Components\PostContentTypeMindMap::class, 'mindmap');

        // TODO подгрузка в шаблон данных (переменная "projectVersion" будет доступна в шаблоне)
        View::composer('layouts.default', function ($view) {

            // Кол-во файлов
            if ($files = Storage::disk('public')->allFiles('.')) {
                $view->with('appFilesCount', count($files));
            }

            $view->with('appDbCountPosts', \App\Models\Post::count());
            $view->with('appProjectVersion', $this->getGitLastTag());

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

    public static function getGitLastTag()
    {
        $HEAD_hash = file_get_contents(base_path().'/.git/refs/heads/master'); // or branch x
        $files = glob(base_path().'/.git/refs/tags/*');
        foreach(array_reverse($files) as $file) {
            $contents = trim(file_get_contents($file));
            if($HEAD_hash === $contents)
            {
                return basename($file); // Current tag is
            }
        }
        return "?.?.?"; // No matching tag
    }
}
