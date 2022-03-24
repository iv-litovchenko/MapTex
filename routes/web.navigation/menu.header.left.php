<?php

use Lavary\Menu\Facade;

// https://github.com/lavary/laravel-menu
// TODO большой недостаток - собирается каждый раз при вызове любой страницы

// Верхнее меню справа
Menu::make('menu.header.left', function ($menu) {
    $menu->add('Главная', ['route'  => 'site.home']);
    $menu->add('Барахолка', ['route'  => 'site.note']);
    $menu->add('Разные картинки', ['route'  => 'site.pic']);
    $menu->add('Книги', ['route'  => 'site.book']);
});
