<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPostUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'parent_id' => 'nullable:posts,id',
            'sorting' => 'integer',
            'branch_stop_flag' => 'integer',
            'is_page_flag' => 'integer',
            'is_draft_flag' => 'integer'
            // 'logo_image' => 'file',
            // 'tags_ids' => 'nullable|array',
            // 'tags_ids.*' => 'nullable|integer|exists:posts.id'
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
