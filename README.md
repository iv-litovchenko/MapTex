<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Изучаем Laravel http://maptex.ru/

- Composer (установка расширений для Laravel)
- NPM (Note.js) - сборка клиентской части на основе Mix
- Маршрутизация и контроллеры
- Модели и миграции
- Загрузка и извлечение файлов Storage::disk('public');
    - php artisan storage:link
    - посмотри то расширение для работы с картинками
- TinyMCE (wysiwyg editor) и composer require mews/purifier
- Request-валидация
- Шаблонизатор Blade
    - Layout
    - Template
    - Component
- Компоненты
- Аутентификация и авторизация
- Гейты и политики (проверка прав доступа)
- Посредники
- Разделы сайта
    - Страницы сайта (типы поста: раздел, страница, фигма, миндпам, шпаргалка)
    - Страницы администрирования (дашборд, управление записями)
- Проверка кода на стандарты PSR (инструменты)
- Документации (генерация документации по классам)
- Документация (вставка: doc/ER-диаграмма, doc/диаграммы классов)
- [todo] Доразобраться с прикреплением картинок (аналог fk внешних ключей в связях между таблицами)
- [todo] Почта
- [todo] Очереди
- [todo] Передача $data в сервис
- [todo] Разобраться с теми ссылками на папку ресурсов (зачем она нужна)
- [todo] Посмотри меню и хлебыне крошки на основе: composer require spatie/laravel-menu
- return redirect()->back()->withSuccess('Категория была успешно удалена')???
- laravel backup (базы/файлов) - composer require spatie/laravel-backup 7.8.0
    - php artisan backup:run

---
Маршруты на основе аннотаций? Автомиграции?

-- TODO по сайту --

- Добавить роли - выпилить мидлваре isme
- Выделение зелененьким активного раздела для Mindmap
- Переделать загрузку картинок... (ее нужно делать после метода save...
- Ajax - попробовать на чем-то
- Версионирование (история изменения записи)
    - https://github.com/mpociot/versionable
    - https://github.com/overtrue/laravel-versionable
    - https://github.com/Antonrom00/laravel-model-changes-history
- Паттерн репозиторий
- Авторизация (изучить)
- Добавить роли
- Закрытый (личный, приватный раздел)
- Прикрепление файла в заметках
- Кэш компонентов spatie / laravel-partialcache Public archive

--

- Laravel DataMapper
- Контроллер - это регулировщик движения (его задача передать выполнение)
- Соглашение об именовании маршрутов (site.controllerName.ActionName)
- Посмотри то меню (можно ли там делать хлебные крошки, можно ли задавать название страницы в Route?)

-- Приоритетное --
> > > Идея с кодами и словами (на примере английского git)
Как быть с тип раздел (он не отображает всех дочек подстраниц страниц?)
МиндМап - веточка в лево (на примере английского языка)?

> Перекинуть файл в другую запись
> Json для файлов?

- Разбрери избранное на Github
- https://github.com/VanOns/laraberg
- https://github.com/VanOns/laraberg-demo
- http://demo.laraberg.io/articles/1706/post.php?post=1&action=edit

-- Блоги

1) https://jonathanbriehl.com/
2) https://si-dev.com/ru/blog/validation-with-formrequest
3) https://laravel.demiart.ru/
4) https://badcode.ru/

-------------------------------
Манифест автомиграции
-------------------------------

- https://github.com/legodion/lucid
- https://github.com/redbastie/laravel-auto-migrate
- https://github.com/mwakalingajohn/laravel-auto-migrations
- https://github.com/bastinald/laravel-automatic-migrations
- Образец идеальной модели (vendor/antonrom00/laravel-model-changes-history/src/Models/Change.php)

-------------------------------
Diff-для истории
-------------------------------
- https://github.com/caxy/php-htmldiff
- https://github.com/vi-kon/laravel-diff
