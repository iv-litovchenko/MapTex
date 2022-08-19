<?php

use DaveJamesMiller\Breadcrumbs\Facades;
use App\Models\Post;

// Главная
Breadcrumbs::for('site.home', function ($trail) {
    // <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
    $trail->push('Главная', route('site.home'));
});

// Главная > Пост (детальная страница) - выводим в виде цепочки
Breadcrumbs::for('site.post', function ($trail, $post) {
    $trail->parent('site.home');
    foreach(Post::defaultOrder()->ancestorsAndSelf($post->id) as $ancestor){
        $trail->push($ancestor->name, route('site.post', $ancestor->id));
    }
});

// Проект
Breadcrumbs::for('site.project', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Проект');
});

// MD TODO
Breadcrumbs::for('site.todo', function ($trail) {
    $trail->parent('site.home');
    $trail->push('TODO по сайту');
});

// Карта сайта
Breadcrumbs::for('site.sitemap', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Карта сайта');
});

// Барахолка
Breadcrumbs::for('site.note', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Барахолка (заметки)');
});

// Разные картинки
Breadcrumbs::for('site.pic', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Барахолка (разные картинки)');
});

// Зарисовки
Breadcrumbs::for('site.figma', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Зарисовки');
});

// Документы
Breadcrumbs::for('site.doc', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Документы');
});

// Книжки
Breadcrumbs::for('site.book', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Книжки');
});

// Поиск по сайту
Breadcrumbs::for('site.search', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Поиск по сайту');
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
    $trail->parent('site.home');
    $trail->push('Администрирование', route('admin.dashboard'));
});

// Главная > Администрирование > Список позиций
Breadcrumbs::for('admin.tvsignal', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Список позиций TV');
});
