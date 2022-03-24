<?php

use DaveJamesMiller\Breadcrumbs\Facades;

// Главная
Breadcrumbs::for('site.home', function ($trail) {
    $trail->push('Главная', route('site.home'));
});

// Барахолка
Breadcrumbs::for('note', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Барахолка');
});

// Разные картинки
Breadcrumbs::for('pic', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Разные картинки');
});

// Книги
Breadcrumbs::for('book', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Книги');
});

// Главная > Вход
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Вход в систему');
});

// Главная > Регистрация
Breadcrumbs::for('register', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Регистрация');
});

// Главная > Забыли пароль?
Breadcrumbs::for('password.email', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Забыли пароль?');
});

// Главная > Администрирование
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Администрирование', route('admin.dashboard'));
});
