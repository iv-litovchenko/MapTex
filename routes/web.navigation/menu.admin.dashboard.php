<?php

use Lavary\Menu\Facade;

// https://github.com/lavary/laravel-menu
// TODO большой недостаток - собирается каждый раз при вызове любой страницы

// Меню из блоков для главной страницы "Панели администратора"
Menu::make('menu.admin.dashboard', function ($menu) {

    $menu->add('Технологии', ['route'  => 'admin.technology.index'])->data('count',0);
    $menu->add('Пользователи', ['route'  => 'admin.user.index'])->data('count',0);

});
