<?php

use Lavary\Menu\Facade;

// Верхнее меню справа
Menu::make('menu.header.right', function ($menu) {

    //    @guest
    //
    //    @else
    //                <li><a href="{{ route('logout') }}"
    //                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    //                           Выйти
    //                    </a></li>
    //                <form action="{{ route('logout') }}" method="post" style="display: none;">
    //        @csrf
    //                    <input type="submit" id="logout-form">
    //                </form>
    //    @endguest

    if (Auth::check()) {
        # $menu->item('profile')->add('Войти', 'login');
        $cab = $menu->add(Auth::user()->name, 'profile');
        $cab->add('Профиль');
        $cab->add('Выход', 'logout');
    } else {
        $cab = $menu->add('Кабинет');
        $cab->add('Войти', 'login');
        $cab->add('Регистрация', 'register');
        $cab->add('Забыли пароль?', 'password.request');
    }
});
