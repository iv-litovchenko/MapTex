<?php

use Lavary\Menu\Facade;

// Верхнее меню справа
Menu::make('menu.header.left', function ($menu) {
    $menu->add('Главная', 'home');
    $menu->add('Барахолка', 'notes');
    $menu->add('Разные картинки', 'pics');
    $menu->add('Книги', 'books');
});
