<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteDocStoreRequest extends FormRequest
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
            'file_path.upload' => 'required|file',
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
            // 'bodytext.*' => 'Опишите содержимое документа',
            'file_path.upload' => 'Прикрепите файл',
        ];
    }
}
