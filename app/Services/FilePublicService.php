<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class FilePublicService
{
    /**
     * Загрузка файла(ов) на диск, возврат имени файла или null
     *
     * Примеры:
     * $path = $this->serviceFilePublic->attachOrDetach(false, 'logo_image', 'site/post/image/')
     * <input type="checkbox" name="image_delete" value="filename.png">
     * <input type="file" name="image">
     *
     * <input type="checkbox" name="images_delete[]" value="filename.png">
     * <input type="file" name="images" multiple>
     *
     * @param bool $multiple
     * @param string $filed
     * @param string $path
     * @return false|string|null
     */
    public function attachOrDetach(
        bool $multiple = false,
        string $filed,
        string $path,
        string|array $defName = null
    ) {
        if ($multiple === false) {
            // Загрузка 1 файла
            if ($file = Request::file($filed)) {
                // $file->getClientOriginalName());
                // $file->getClientOriginalExtension();
                // $path = $request->file('logo_image')->store('site/post/logo', 'public');
                $savePath = Storage::disk('public')->putFile($path, $file);
                return basename($savePath);

                // Удаление файла
            } elseif (Request::input($filed . '_delete')) {
                if (Storage::disk('public')->delete($path . '/' . $defName)) {
                    return null;
                }
            }
            return $defName;

        } elseif ($multiple === true) {
            $result = [];
            if ($files = Request::file($filed)) {
                foreach ($files as $file) {
                    $savePath = Storage::disk('public')->putFile($path, $file);
                    $result[] = basename($savePath);
                }
            }
            if ($filesDelete = Request::input($filed . '_delete')) {
                foreach ($filesDelete as $fileDelete) {
                    if (Storage::disk('public')->delete($path . '/' . $fileDelete)) {

                    }
                }
            }
            return $result;
        }
        return false;
    }

    /**
     * Чтение с публичного диска
     *
     * @param string $path
     * @return array
     */
    public function files($path)
    {
        if ($files = Storage::disk('public')->files($path)) {
            return $files;
        }
        return [];
    }
}
