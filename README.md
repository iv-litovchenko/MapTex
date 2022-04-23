<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Изучаем Laravel http://maptex.ru/

-------------------------------
Двигаемся
-------------------------------

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
Идея фич для проекта
-------------------------------

- Посмотри то меню (можно ли там делать хлебные крошки, можно ли задавать название страницы в Route?)
- Добавить роли на проекте - выпилить мидлваре "isMe"
- Идея с кодами и словами (на примере английского и git команд)
- Как быть с тип "раздел" (он не отображает всех дочек подстраниц страниц)
- МиндМап - веточка в лево (на примере английского языка)
- МиндМап - выделение зелененьким активного раздела для Mindmap
- Файлы (перекинуть файл в другую запись, json для файлов)
- Прикрепление файла в заметках
- Паттерн репозиторий

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
2) https://si-dev.com/ru/blog/validation-with-formrequest
3) https://laravel.demiart.ru/
4) https://badcode.ru/

-------------------------------
Манифест автомиграции
-------------------------------

- https://github.com/NastuzziSamy/laravel-orm/blob/master/src/Traits/HasORM.php
- https://github.com/legodion/lucid
- https://github.com/redbastie/laravel-auto-migrate
- https://github.com/mwakalingajohn/laravel-auto-migrations
- https://github.com/bastinald/laravel-automatic-migrations
- Образец идеальной модели (vendor/antonrom00/laravel-model-changes-history/src/Models/Change.php)
- https://habr.com/ru/post/543190/
- https://github.com/kitloong/laravel-migrations-generator
- "dump sql migration laravel"
- https://stackoverflow.com/questions/31263637/how-to-convert-laravel-migrations-to-raw-sql-scripts
- DB::listen) или как там)

---
Синхронизация БД должна соответствовать коды который замыслил программист.
Миграция - способ версионирования бд. Каждая миграция - это аналог коммита в гит.
Думаешь про одно состояние структуры, а по факту там уже другое.

Code style для миграций:
* Таблицы и колонки не удаляются
* Все колонки null
* Колонки типа bool, статусов - имеют значения по умолчанию

Отлуп:
* если колонка уже есть, 
* если переименование колонки,
* если тип данных не соответствует представлению
* если слили модель и в ней есть два раза добавление колонки

! Что бы проверить корректность работы пишутся тесты.
! Если несколько модулей будут создавать одинаковые таблицы (колонки), миграции должны падать.

Проблема:
* Вася создал колонкку (position) и записал в нее данные женат
* Петя создал колонку (position) и записал в нее данные программист

Как в доктрине.
Генерация реальных файлов с миграциями на основе диффа модели и состояния БД.
Делало слепок и создавало актуальную миграцию

-------------------------------
Diff-для истории
-------------------------------
- https://github.com/caxy/php-htmldiff
- https://github.com/vi-kon/laravel-diff
