<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // TODO подключаем меню и хлебные крошки
        $files = glob(base_path('routes/web.navigation/*.php'));
        foreach ((array) $files as $file) {
            require $file;
        }

        return $next($request);
    }
}
