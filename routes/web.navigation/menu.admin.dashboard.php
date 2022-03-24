<?php

use Lavary\Menu\Facade;
use App\Models\Technology;
use App\Models\User;

// https://github.com/lavary/laravel-menu
// TODO большой недостаток - собирается каждый раз при вызове любой страницы

// Меню из блоков для главной страницы "Панели администратора"
Menu::make('menu.admin.dashboard', function ($menu) {

    $menu->add('Технологии', ['route' => 'admin.technology.index'])->data('count', Technology::count());
    $menu->add('Пользователи', ['route' => 'admin.user.index'])->data('count', User::count());

});
