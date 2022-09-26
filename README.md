<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Изучаем Laravel http://maptex.ru/

-------------------------------
# Установка
-------------------------------

- $ sh .bash/install.sh
- $ sh .bash/docker-up.sh
- $ sh .bash/docker-down.sh

- Логин и пароль для входа
- http://localhost:8010/
- http://localhost:8010/login
- Login: iv-litovchenko@mail.ru
- Password: 100
- http://localhost:8012/
- http://localhost:8013/

-------------------------------
Двигаемся
-------------------------------

- Deploy (непрерывная интеграция, автоматизация)
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
2) https://laravel.demiart.ru/
3) https://badcode.ru/
4) https://matthiasnoback.nl/
5) https://stitcher.io/

-------------------------------
Diff-для истории
-------------------------------

- https://github.com/caxy/php-htmldiff
- https://github.com/vi-kon/laravel-diff

-------------------------------
Идея фич для проекта
-------------------------------

- Идея парсить исходный код этого проекта (любые файлы, все что нельзя задокументирвать через phpdoc) и забирать комментарии в таблицу
- Посмотри то меню (можно ли там делать хлебные крошки, можно ли задавать название страницы в Route?)
- Добавить роли на проекте - выпилить мидлваре "isMe"
- MindMap на основе SVG
- МиндМап - веточка в лево (на примере английского языка)
- МиндМап - выделение зелененьким активного раздела для Mindmap
- Файлы (перекинуть файл в другую запись, сделать замену файла, выбрать из существующих, перевести на json для файлов)
- Вставать мою фотку в йоги Вставить баннер с яндекса Диска Вывести тот баннер приветствие на главной с

-------------------------------

- CI CD
- # Собрать отчеты
- # Сделать копии папок
- # Креш при тесте...

- мастер слейв (master slave), https://www.digitalocean.com/community/tutorials/how-to-set-up-replication-in-mysql
- nrock
- 
- Отправить git hook в удаленный репозиторий
- Именование веток (maptex-task-10)

Volume-опрокинуть
> gosu, su-exec, setpriv, ...
> но при условии, что переключаешься из root-а в другого пользователя
