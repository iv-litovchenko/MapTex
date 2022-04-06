<?php

namespace App\Services;

use http\Exception;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Обработка сохранения/удаления файла для модели
 *
 * Загрузка файла(ов) на диск, возврат имени файла или null для записи в БД
 * Примеры:
 *
 * -- HTML --
 *
 * <!-- One file-->
 * <input type="file" name="logo_image[upload]">
 * <input type="checkbox" name="logo_image[delete]" value="1">
 *
 * <!-- Multi files -->
 * <input type="file" name="images[upload][]" multiple>
 * <input type="input" name="images[sorting][{{ md5($filename) }}]" value="1">
 * <input type="input" name="images[sorting][{{ md5($filename) }}]" value="2">
 * <input type="checkbox" name="images[delete][{{ md5($filename) }}]" value="1">
 * <input type="checkbox" name="images[delete][{{ md5($filename) }}]" value="1">
 *
 * -- PHP --
 * $model = new Post;
 * $model->name = 'foo';
 * $model->logo_image = $this->fileAttachDetachService->oneFile($model->logo_image, 'logo_image', 'site/post', 'public');
 * $model->images = $this->fileAttachDetachService->manyFiles($model->images, 'images', 'site/post', 'public');
 * $model->save();
 */
class FileAttachDetachService
{
    /** @var \Illuminate\Support\Facades\Request */
    private $requst;

    /** @var \Illuminate\Support\Facades\Storage */
    private $storage;

    /**
     * Конструктор
     *
     * @return void
     */
    public function __construct()
    {
        $this->requst = new Request;
        $this->storage = new Storage;
    }

    /**
     * Проверка входящих аргументов для работы функции
     *
     * @param array $args
     * @return \Exception|void
     */
    public function checkArgs(array ...$args)
    {
        if ($args[0][1] === null) {
            throw new \Exception('');
        }
    }

    /**
     * Загрузка (удаление по галочке) 1 файла
     *
     * @param string|null $defaultValue
     * @param string $formFieldName
     * @param string $savePath
     * @param string $diskName
     * @return string|null
     */
    public function oneFile(
        string|null $defaultValue = null,
        string $formFieldName = 'image',
        string $savePath = 'site/dir',
        string $diskName = 'public'
    ) {
        // Проверка аргументов
        // $this->checkArgs(func_get_args());

        // $file->getClientOriginalName());
        // $file->getClientOriginalExtension();
        // $path = $request->file('logo_image')->store('site/post/logo', 'public');

        // Загрузка 1 файла
        if ($file = $this->requst::file($formFieldName . '.upload')) {
            $fullFilePathAndName = $this->storage::disk($diskName)->putFile($savePath, $file);
            return $fullFilePathAndName;
        }

        // Удаление 1 файла (удаление идет по проверке!)
        if (intval($this->requst::input($formFieldName . '.delete')) === 1) {
            if ($this->storage::disk($diskName)->delete($defaultValue)) {
                return null;
            }
        }

        // Возврат старого значения
        return $defaultValue;
    }

    /**
     * Загрузка (удаление по галочке) нескольких файлов файла
     *
     * Дополнительно:
     * - Загрузка новых файлов
     * - Сортировка файлов
     * - Замена файлов
     * - Удаление файлов (по галочке)
     *
     * @param string|null $defaultValue
     * @param string $formFieldName
     * @param string $savePath
     * @param string $diskName
     * @return string|null
     */
    public function manyFiles(
        string|null $defaultValue = null,
        string $formFieldName = 'images',
        string $savePath = 'site/dir',
        string $diskName = 'public'
    ) {
        // Проверка аргументов
        // $this->checkArgs(func_get_args());

        $result = [];
        if (!empty($defaultValue)) {
            $defaultValueArray = explode(chr(10), $defaultValue);
            if (is_array($defaultValueArray) && !empty($defaultValueArray)) {
                foreach ($defaultValueArray as $value) {
                    $result[md5($value)] = $value;
                }
            } else {
                $result[md5($defaultValue)] = $defaultValue;
            }
        }

        // Загрузка файлов
        if ($files = $this->requst::file($formFieldName . '.upload')) {
            foreach ($files as $file) {
                $fullFilePathAndName = $this->storage::disk($diskName)->putFile($savePath, $file);
                $result[md5($fullFilePathAndName)] = $fullFilePathAndName;
            }
        }

        // Удаление файлов (удаление идет по проверке!)
        if ($filesDelete = $this->requst::input($formFieldName . '.delete')) {
            foreach ($filesDelete as $md5FileDelete => $valueConfirm) {
                if (key_exists($md5FileDelete, $result) && intval($valueConfirm) === 1) {
                    if ($this->storage::disk($diskName)->delete($result[$md5FileDelete])) {
                        unset($result[$md5FileDelete]);
                    }
                }
            }
        }

        // Сортировка файлов
        if ($filesSorting = $this->requst::input($formFieldName . '.sorting')) {
            foreach ($filesSorting as $md5FileSorting => $valueSorting) {
                if (key_exists($md5FileSorting, $result) && intval($valueSorting) > 0) {
                    // TODO
                }
            }
        }

        // Возвращаем результат
        if (count($result) > 0) {
            return implode(chr(10), $result);
        }

        return null;
    }
}
