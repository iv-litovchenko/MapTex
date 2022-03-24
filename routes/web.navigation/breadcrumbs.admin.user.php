<?php

use DaveJamesMiller\Breadcrumbs\Facades;

// Главная > Администрирование > Пользователи
Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->parent('site.home');
    $trail->parent('admin.dashboard');
    $trail->push('Пользователи', route('admin.user.index'));
});

// Главная > Администрирование > Пользователи > Добавить
Breadcrumbs::for('admin.user.create', function ($trail) {
    $trail->parent('admin.user.index');
    $trail->push('Добавить');
});

// Главная > Администрирование > Пользователи > Редактировать
Breadcrumbs::for('admin.user.edit', function ($trail) {
    $trail->parent('admin.user.index');
    $trail->push('Редактировать');
});

