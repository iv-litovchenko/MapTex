<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteBookStoreRequest extends FormRequest
{
    /**
     * Список правил валидации
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'bodytext' => 'required|min:3|max:255',
            'image_path.upload' => 'required|image',
        ];
    }

    /**
     * Сообщения для правил валидации
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'bodytext.*' => 'Опишите содержимое книги',
            'file_path.upload' => 'Прикрепите изображение',
        ];
    }
}
