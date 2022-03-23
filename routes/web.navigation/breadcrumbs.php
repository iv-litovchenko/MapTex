<?php

use DaveJamesMiller\Breadcrumbs\Facades;

// Главная
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('home'));
});

// Барахолка
Breadcrumbs::for('notes', function ($trail) {
    $trail->parent('home');
    $trail->push('Барахолка', route('notes'));
});

// Разные картинки
Breadcrumbs::for('pics', function ($trail) {
    $trail->parent('home');
    $trail->push('Разные картинки', route('pics'));
});

// Книги
Breadcrumbs::for('books', function ($trail) {
    $trail->parent('home');
    $trail->push('Книги', route('books'));
});

// Главная > Вход
Breadcrumbs::for('auth.login', function ($trail) {
    $trail->parent('home');
    $trail->push('Вход в систему');
});

// Главная > Регистрация
Breadcrumbs::for('auth.register', function ($trail) {
    $trail->parent('home');
    $trail->push('Регистрация');
});

// Главная > Администрирование
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Администрирование', route('admin.dashboard'));
});
