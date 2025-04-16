# PHP Composer (менеджер и подгрузчик пакетов, компонентов и зависимостей (composer.json) по стандарту PSR-4)
> Пакетный менеджер позволяет подключать сторонник код (пакеты) к нашему проекту \
> https://getcomposer.org/download/ \
> https://packagist.org/

- Название пакета состоит из [Автор(Огранизация)]/[Пакет]
- composer.json -> располагается в корне проекта
- composer.lock -> добавляется в git, содержит дерево зависимостпей и версий загруженных пакетов
- composer.lock-файл хранит в себе точные версии всех устанолвенных пакетов, что бы воссоздать именно то окружение, которое задумал разработчик
- Подключение автозагрузчика происходит через require_once \__DIR__ . '/vendor/autoload.php';
- "vendor/bin/..." содержит исполняемые команды-пакеты .bat (для Windows).
- Что бы обратиться из корня проекта нужно писать "php ./vendor/bin/phinx init"
- Секция "require-dev" в файле composer.json нужна для зависимостей при локальной разработке, что бы пакеты не ушли в прод

---

- Семантическое версионирование [1].[1].[0] = [Мажорная-версия].[Минорная-верия].[Патч-версия]
- "*" - разрешает обновление мажорной версии
- "^" - символ каретки разрешает обновление минорной и патч-версии
- "~" - разрешает обновление только патс-версии

---

### Команды

```bash
$ composer init
$ composer info
$ composer -v
$ composer --version
$ composer run-script build:app

$ composer install # если есть *.lock-файл установит версии пакетов из него
$ composer update # обновит все пакеты до самых свежих версий
$ composer update --no-dev # без секции "require-dev"
$ composer update symfony/symfony # обновить отдельный пакет-зависимость

$ composer require symfony/symfony # установить пакет
$ composer require symfony/symfony --dev # установка с флагом дев (только для разработки)

$ composer dump-autoload # обновить файл autoloader.php
$ composer dump-autoload -o # оптимизированный вариант
$ php ./vendor/bin/phinx init # запуст скриптов из корня проекта

# Столкнувшись с конфликтом "composer.lock" необходимо принять версию composer файлов из удаленной ветки
$ git checkout origin/{base} -- composer.lock composer.json

# Обновление через php
$ which php8.1
$ <php8.1> -d memory_limit=-1 /usr/local/bin/composer-phar update --no-plugins --ignore-platform-reqs
$ <php> composer install -n --ignore-platform-req=ext-gd
```