<?php

use DaveJamesMiller\Breadcrumbs\Facades;

// Главная > Администрирование > Технологии
Breadcrumbs::for('admin.technology.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Технологии', route('admin.technology.index'));
});

// Главная > Администрирование > Технологии > Добавить
Breadcrumbs::for('admin.technology.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->parent('admin.technology.index');
    $trail->push('Добавить');
});

// Главная > Администрирование > Технологии > Добавить
Breadcrumbs::for('admin.technology.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->parent('admin.technology.index');
    $trail->push('Редактировать');
});
