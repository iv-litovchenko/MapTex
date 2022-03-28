<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPostStoreRequest extends FormRequest
{
    /**
     * Флаг авторизации пользователя
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Список правил валидации
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50'
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
            'name.*' => 'Название заполнено не правильно',
        ];
    }
}
