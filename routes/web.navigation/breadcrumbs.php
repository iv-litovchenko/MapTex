<?php

use DaveJamesMiller\Breadcrumbs\Facades;

// Главная
Breadcrumbs::for('site.home', function ($trail) {
    $trail->push('Главная', route('site.home'));
});

// Барахолка
Breadcrumbs::for('site.note', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Барахолка');
});

// Разные картинки
Breadcrumbs::for('site.pic', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Разные картинки');
});

// Книги
Breadcrumbs::for('site.book', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Книги');
});

// Поиск по сайту
Breadcrumbs::for('site.search', function ($trail) {
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

// Главная > Сброс пароля
Breadcrumbs::for('password.update', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Сброс пароля');
});

// Главная > Администрирование
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Администрирование', route('admin.dashboard'));
});
