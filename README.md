<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

---
Маршруты на основе аннотаций?
Автомиграции?

-- TODO по сайту --

- Добавить роли - выпилить мидлваре isme
- Выделение зелененьким активного раздела для Mindmap
- Переделать загрузку картинок... (ее нужно делать после метода save...
- Ajax - попробовать на чем-то
- Версионирование (история изменения записи)
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
>>> Идея с кодами и словами (на примере английского git)
Как быть с тип раздел (он не отображает всех дочек подстраниц страниц?)
МиндМап - веточка в лево (на примере английского языка)?

> Перекинуть файл в другую запись
> Json для файлов?

