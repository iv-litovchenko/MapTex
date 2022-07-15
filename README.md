<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Изучаем Laravel http://maptex.ru/

-------------------------------
Установка
-------------------------------

>> php artisan migrate:auto --seed

-------------------------------
Двигаемся
-------------------------------

- Vue
- Docker
- Composer (установка расширений для Laravel)
- NPM (Note.js) - сборка клиентской части на основе Mix
- Маршрутизация и контроллеры
- Модели и миграции
- Загрузка и извлечение файлов Storage::disk('public');
    - php artisan storage:link
- TinyMCE (wysiwyg editor) и composer require mews/purifier
- Request-валидация
- Шаблонизатор Blade
    - Layout
    - Template
    - Partials
    - Component (для шаблона)
- Полноценные компоненты
- Аутентификация и авторизация
- Гейты и политики (проверка прав доступа)
    - Политики
- Посредники (middlware)
- Проверка кода на стандарты PSR (инструменты)
- Документации (генерация документации по классам)
- Документация (вставка: doc/ER-диаграмма, doc/диаграммы классов)
- [todo] Доразобраться с прикреплением картинок (аналог fk внешних ключей в связях между таблицами)
- [todo] Почта
- [todo] Ajax - попробовать на чем-то
- [todo] Очереди
- [todo] Работа с файлами

-------------------------------
Использованные пакеты
-------------------------------

- laravel backup (базы/файлов) - composer require spatie/laravel-backup (php artisan backup:run)

-------------------------------
Редактор текста (аналог)
-------------------------------

- https://github.com/VanOns/laraberg
- https://github.com/VanOns/laraberg-demo
- http://demo.laraberg.io/articles/1706/post.php?post=1&action=edit

-------------------------------
Блоги
-------------------------------

1) https://jonathanbriehl.com/
3) https://laravel.demiart.ru/
4) https://badcode.ru/

-------------------------------
Diff-для истории
-------------------------------
- https://github.com/caxy/php-htmldiff
- https://github.com/vi-kon/laravel-diff

-------------------------------
Идеи
-------------------------------
- html CSS вертска (фрейм)
- json для загрузки файлов
- автомиграции
- crud из TYPO3
- создание связей link, unlink + автосвязи, mediaLink, mediaUnlink
