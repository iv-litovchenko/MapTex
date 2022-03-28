<?php

use DaveJamesMiller\Breadcrumbs\Facades;

// Главная > Администрирование > Посты
Breadcrumbs::for('admin.post.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Посты', route('admin.post.index'));
});

// Главная > Администрирование > Посты > Добавить
Breadcrumbs::for('admin.post.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->parent('admin.post.index');
    $trail->push('Добавить');
});

// Главная > Администрирование > Посты > Добавить
Breadcrumbs::for('admin.post.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->parent('admin.post.index');
    $trail->push('Редактировать');
});
