# Node.js (менеджер и подгрузчик JS-пакетов (package.json))
> Пакетный менеджер позволяет подключать сторонник код (пакеты) к нашему проекту \
> "npm" - менеджер пакетов, зависимостей JS \
> "yarn" - менеджер пакетов, зависимостей (создан Google, Facebook) \
> https://nodejs.org/ru/download/current/

- Исполняемые пакеты располагаются в папке "bin/"
- Node.Js - это интерпретатор на C++ (получает на входе код JS и выполняет его)

---

- Семантическое версионирование [1].[1].[0] = [Мажорная-версия].[Минорная-верия].[Патч-версия]
- "*" - разрешает обновление мажорной версии
- "^" - символ каретки разрешает обновление минорной и патч-версии
- "~" - разрешает обновление только патс-версии

---

### Общие команды

```bash
$ node -h # показывает список всех доступных команд Node.js
$ node -v # версия
$ npm -v # версия
```

### Создание проекта

```bash
$ npm init # создать новый пакет
$ npm init --yes # файл будет создан со значениями по умолчанию
$ npm info
```

### Пакеты package.json (установка/удаление/обновление)

```bash
$ npm list # список установленных пакетов (package.json)
$ npm outdated # показать список пакетов которые могут быть обновлены
$ npm update # обновить все пакеты
$ npm update [название пакета] # обновить 1 пакет

$ npm search [bootstrap] # поиск пакетов
$ npm view [bootstrap] # информация о пакете
$ npm home [bootstrap] # ссылка на дом. страницу
$ npm repo [bootstrap] # ссылка на гитхаб

# Когда "install" - установка конкретно тех, версий пакетов, которые указаны в package.json
# Когда "update" - установка последних версии пакетов и перезапись файла package.json
$ npm install # установка всех пакетов с сайта npmjs.com
$ npm install --production # установка всех пакетов только секция продакш - для продакшина
$ npm install --global gulp # установка глобально
$ npm install [название пакета]@4.1.1 # добавить пакет
$ npm install [название пакета] --save-dev # добавить пакет - в секцию dev
$ npm unstall [название пакета] # удалить пакет
$ ./node_modules/grunt-cli/bin/grunt # выполнить пакет
```

### Laravel webpack.mix.js (сборщик web-приложения - несколько скриптов в 1 файл)

```bash
$ npm run dev # собрать js, css-файлы
$ npm run prod # собрать js, css-файлы для продакшина (комментарии будут вырезаны, файлы сжаты)
$ npm run watch # отслеживать и пересобирать js, css-файлы в режиме реального времени
```

## Скриншоты

![](https://raw.githubusercontent.com/iv-litovchenko/WebNote/main/Uploads/backend.Php.Dm.Npm/hNg2AEyL2zcsO63G5xhSJNLoPQ6vFSqmTL01DrDG.png)
![](https://raw.githubusercontent.com/iv-litovchenko/WebNote/main/Uploads/backend.Php.Dm.Npm/6dbahu0XHF1N8mVE4LrwegLyogQgs9enSlrgbQsA.png)
![](https://raw.githubusercontent.com/iv-litovchenko/WebNote/main/Uploads/backend.Php.Dm.Npm/R5RER5TFSJsKrRXmIrrZ8WKWp1xoGhZoNXcQ1cwh.png)
![](https://raw.githubusercontent.com/iv-litovchenko/WebNote/main/Uploads/backend.Php.Dm.Npm/Grs3BKREr7d9F34vc3OTBbtsA6p0ygpBDqtT9VNl.png)
![](https://raw.githubusercontent.com/iv-litovchenko/WebNote/main/Uploads/backend.Php.Dm.Npm/jJlZkbhMv3Uhx2dwJ04cLYmDt6uf3mnKZ4doUFCO.png)
