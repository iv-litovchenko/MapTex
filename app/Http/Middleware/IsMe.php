<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class IsMe
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверка на localhost (редактировать можно только на боевом)
//        $host = $request->getHost();
//        if ($host == 'localhost') {
//            echo 'Localhost (edit disabled)!!!';
//            exit();
//        }

        if ((int)auth()->user()->role !== User::ROLE_ADMIN) {
            abort(404);
        }

        // Проверка на авторизацию
        $backendOpenStatus = Cookie::get('BACKEND_OPEN');
        if ($backendOpenStatus !== 'yes') {
            return redirect('login');
        }
        return $next($request);
    }
}
