<?php

use Lavary\Menu\Facade;

// Верхнее меню справа
Menu::make('menu.header.right', function ($menu) {
    if (Auth::check()) {
        $cab = $menu->add(Auth::user()->email, ['class' => 'dropdown']);
        $cab->append('<span class="caret"></span>');
        $cab->link->attr([
            'class' => 'nav-link dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button',
            'aria-expanded' => 'false',
        ]);
        $cab->add('Профиль', '#');
        $cab->add('Выход', ['route' => 'logout'])->link->attr([
            'onclick' => "$('#logout-form').submit(); return false;"
        ]);
    } else {
        $cab = $menu->add('Личный кабинет', ['class' => 'dropdown']);
        $cab->append('<span class="caret"></span>');
        $cab->link->attr([
            'class' => 'nav-link dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button',
            'aria-expanded' => 'false',
        ]);
        $cab->add('Войти', ['route' => 'login']);
        $cab->add('Регистрация', ['route' => 'register']);
        $cab->add('Забыли пароль?', ['route' => 'password.request']);
    }
});
