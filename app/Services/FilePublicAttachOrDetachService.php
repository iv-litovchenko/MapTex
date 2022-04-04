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
    /** @var string */
    private $formFieldName = '';

    /** @var string */
    private $defValue = '';

    /** @var string */
    private $savePath = '.';

    /** @var string */
    private $stringForDatabaseRow = '';

    /**
     * Конструктор
     *
     * @param string $formFieldName
     * @param string $defValue
     * @param string $savePath
     * @return false|string|null
     */
    public function __construct(
        string $formFieldName,
        string $defValue = null,
        string $savePath = '.'
    ) {
        $this->formFieldName = $formFieldName;
        $this->defValue = $defValue;
        $this->oneFileProcess();

        //        if ($multiple === false) {
        //
        //
        //        } elseif ($multiple === true) {
        //            $result = [];
        //            if ($files = Request::file($filed)) {
        //                foreach ($files as $file) {
        //                    $savePath = Storage::disk('public')->putFile($path, $file);
        //                    $result[] = basename($savePath);
        //                }
        //            }
        //            if ($filesDelete = Request::input($filed . '_delete')) {
        //                foreach ($filesDelete as $fileDelete) {
        //                    if (Storage::disk('public')->delete($path . '/' . $fileDelete)) {
        //
        //                    }
        //                }
        //            }
        //            return $result;
        //        }
        //        return false;
    }

    /**
     * Возвращаем строку для записи в БД
     *
     * @return string
     */
    public function __toString()
    {
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
            $this->stringForDatabaseRow = basename($savePath);

            // Удаление файла
        } elseif (Request::input($this->formFieldName . '_delete')) {
            if (Storage::disk('public')->delete($this->defValue)) {
                $this->stringForDatabaseRow = null;
            }
        }

        $this->stringForDatabaseRow = $this->defValue;
    }

    /**
     * Чтение с публичного диска
     *
     * @param string $path
     * @return array
     */
    public function files($path)
    {
        //        if ($files = Storage::disk('public')->files($path)) {
        //            $sortFiles = [];
        //            foreach ($files as $file) {
        //                $time = Storage::disk('public')->lastModified($file);
        //                $sortFiles[$time] = $file;
        //            }
        //            #dd($files);
        //            return $files;
        //        }
        //        return [];
    }
}
