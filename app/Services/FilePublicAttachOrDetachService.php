<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Загрузка файла(ов) на диск, возврат имени файла или null для записи в БД
 *
 * Примеры:
 * $path = new FilePublicAttachOrDetachService('logo_image', '1.png', 'site/post/image/');
 * <input type="checkbox" name="image_delete" value="filename.png">
 * <input type="file" name="image">
 *
 * <input type="checkbox" name="images_delete[]" value="filename.png">
 * <input type="file" name="images[]" multiple>
 */
class FilePublicAttachOrDetachService
{
    /** @var bool */
    private $isMultiple = false;

    /** @var string */
    private $formFieldName = '';

    /** @var string */
    private $defValue = '';

    /** @var string */
    private $savePath = '.';

    /** @var string */
    private $stringForDatabaseRow = null;

    /**
     * Конструктор
     *
     * @param bool $isMultiple
     * @param string $formFieldName
     * @param string $defValue
     * @param string $savePath
     * @return false|string|null
     */
    public function __construct(
        bool $isMultiple = false,
        string $formFieldName,
        string $defValue = null,
        string $savePath = '' // '.'
    )
    {
        $this->stringForDatabaseRow = $defValue;
        $this->formFieldName = $formFieldName;
        $this->savePath = $savePath;
        if ($isMultiple === false) {
            $this->defValue = $defValue;
            $this->oneFileProcess();
        } elseif ($isMultiple === true) {
            if(!empty($defValue)){
                $this->defValue = explode(chr(10), $defValue);
            } else{
                $this->defValue = $defValue;
            }
            $this->multipleFilesProcess();
        }
    }

    /**
     * Возвращаем строку для записи в БД
     *
     * @return string|null
     */
    public function __toString()
    {
        if($this->stringForDatabaseRow === null){
            return '';
        }
        return $this->stringForDatabaseRow;
    }

    /**
     * Загрузка (удаление по галочке) 1 файла
     *
     * @return string|null
     */
    private function oneFileProcess()
    {
        // $file->getClientOriginalName());
        // $file->getClientOriginalExtension();
        // $path = $request->file('logo_image')->store('site/post/logo', 'public');

        // Загрузка 1 файла
        if ($file = Request::file($this->formFieldName)) {
            $savePath = Storage::disk('public')->putFile($this->savePath, $file);
            $this->stringForDatabaseRow = $savePath;

            // Удаление файла
        } elseif (Request::input($this->formFieldName . '_delete')) {
            if (Storage::disk('public')->delete($this->defValue)) {
                $this->stringForDatabaseRow = null;
            }

            // Возврат старого значения
        } else {
            $this->stringForDatabaseRow = $this->defValue;
        }
    }

    /**
     * Загрузка (удаление по галочке) нескольких файлов файла
     *
     * Сортировка
     * Замена
     * Удаление
     *
     * @return string|null
     */
    private function multipleFilesProcess()
    {
        $result = [];
        if (is_array($this->defValue)) {
            foreach ($this->defValue as $value) {
                $result[$value] = $value;
            }
        }

        // Загрузка файлов
        if ($files = Request::file($this->formFieldName)) {
            foreach ($files as $file) {
                $savePath = Storage::disk('public')->putFile($this->savePath, $file);
                $result[$savePath] = $savePath;
            }
        }

        // TODO Удаление файлов
        if ($filesDelete = Request::input($this->formFieldName . '_delete')) {
            foreach ($filesDelete as $fileDelete) {
                if (Storage::disk('public')->delete($this->savePath . '/' . $fileDelete)) {

                }
            }
        }

        // TODO Сортировка файлов
        // ...

        if(count($result) > 0){
            $this->stringForDatabaseRow = implode(chr(10), $result);
        } else {
            $this->stringForDatabaseRow = null;
        }
    }
}
