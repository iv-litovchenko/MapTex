<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Changelog

- TODO Передача $data в сервис
- TODO Попробовать почту 
- TODO Попробовать очереди
- Шаблоны
- Главная дашборда

---------------
Node.js (NPM)
---------------
node -h — показывает список всех доступных команд Node.js.
node -v версия
npm -v версия
npm init (создать новый пакет)
npm init --yes (файл будет создан со значениями по умолчанию)

-- Поиск пакетов
npm search [bootstrap] (поиск пакетов)
npm view [bootstrap] (информация о пакете)
npm view [bootstrap] versions
npm home [bootstrap] (ссылка на дом. страницу)
npm repo [bootstrap] (ссылка на гитхаб)
npm list (список установленных пакетов)

-- Установка/удаление/обновление пакетов
npm install (установка всех пакетов сайта npmjs.com)
npm install --production (установка всех пакетов только секция продакш - для продакшина)
npm install [название пакета] (добавить пакет)
npm install [название пакета]@4.1.1
npm install [название пакета] --save-dev (добавить пакет - в секцию dev)
npm install webpack --save-dev
npm unstall [название пакета] (удалить пакет)
npm outdated (показать список пакетов которые могут быть обновлены)
npm update 
npm update [название пакета]

-- Исполняемые пакеты (bin/-папка)
-- Установка глобально (с флагом -g)

-- Версии 
[1].[1].[0]
[Мажорная-версия].[Минорная-верия].[Патч-версия]
* - разрешает обновление мажорной версии
^ - символ каретки разрешает обновление минорной и патч-версии
~ - разрешает обновление только патс-версии

---
-- (Larael webpack.mix.js)
npm run dev (Larael для продакшина)
npm run prod (Larael для продакшина)
