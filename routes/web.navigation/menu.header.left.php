<?php

use Lavary\Menu\Facade;

// https://github.com/lavary/laravel-menu
// TODO большой недостаток - собирается каждый раз при вызове любой страницы

// Верхнее меню справа
Menu::make('menu.header.left', function ($menu) {
    $menu->add('Главная', ['route'  => 'site.home']);

    $top = $menu->add('Барахолка', ['class' => 'dropdown']);
    $top->append('<span class="caret"></span>');
    $top->link->attr([
        'class' => 'nav-link dropdown-toggle',
        'data-toggle' => 'dropdown',
        'role' => 'button',
        'aria-expanded' => 'false',
    ]);
    $top->add('Заметки', ['route'  => 'site.note']);
    $top->add('Разные картинки', ['route'  => 'site.pic']);

    $menu->add('Зарисовки', ['route'  => 'site.figma']);
    $menu->add('PHP-тест', 'phptest');
    $menu->add('Документы', ['route'  => 'site.doc']);
    $menu->add('Книжки', ['route'  => 'site.book']);
    $menu->add('Проект', ['route'  => 'site.project']);
});
