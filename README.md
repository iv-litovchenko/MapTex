<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Changelog http://maptex.ru/

- Composer (установка расширений для Laravel)
- NPM (Note.js) - сборка клиентской части на основе Mix
- Маршрутизация и контроллеры
- Модели и миграции
- Загрузка и извлечение файлов Storage::disk('public');
  -  php artisan storage:link
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
  - Стрнаницы сайта 
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

---
Маршруты на основе аннотаций?
Автомиграции?

-- TODO по сайту --
+ Все таки сделай защиту картинок от удаления!!!
- Добавить роли - выпилить мидлваре isme
- Типы (страница, фигма, миндпам, шпаргалка)
- Выделение зелененьким активного раздела
- Переделать загрузку картинок... (ее нужно делать после метода save...
  - Посмотреть разширение для работы с картинкаи)
  - Сортировка картинок
- Ajax - попробовать на чем-то
- Версионирование (история изменения записи)
- Паттерн репозиторий
- Авторизация (изучить)
- Добавить роли
- Добавить тип записи (раздел, шпаргалка, миндмап, страница)
- Кэш компонентов spatie / laravel-partialcache Public archive
- laravel backup (файлов)
- laravel backup (базы)

--
- Laravel DataMapper
- Контроллер - это регулировщик движения (его задача передать выполнение)
- Соглашение об именовании маршрутов (site.controllerName.ActionName)
- Посмотри то меню (можно ли там делать хлебные крошки, можно ли задавать название страницы в Route?)
- Посмотри как работать с файлами

-- Приоритетное --
>>> Главная (плиточки) https://getbootstrap.ru/articles

Защита от изменения род. раздела
Остановку для всех кроме страниц
Как быть с тип раздел (он не отображает всех дочек подстраниц страниц?)
МиндМап - выделение зеленым, если это миндмап...
МиндМап - веточка в лево (на примере английского языка)?
