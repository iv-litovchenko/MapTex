<?php

use DaveJamesMiller\Breadcrumbs\Facades;

// Главная > Администрирование > Todo > Добавить
Breadcrumbs::for('admin.todo.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Добавить');
});

// Главная > Администрирование > Todo > Редактировать
Breadcrumbs::for('admin.todo.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Редактировать');
});
