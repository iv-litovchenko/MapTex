<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserUpdateRequest extends FormRequest
{
    /**
     * Флаг разрешения отправки формы
     * <true>, предоставляя право всем желающим отправлять форму
     * <false>, предоставляя право только авторизовавшимся пользователям
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
            'name.*' => 'Имя заполнено не правильно'
        ];
    }
}
