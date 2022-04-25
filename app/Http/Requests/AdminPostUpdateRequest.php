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
            'name' => 'required|min:3|max:255',
            'parent_id' => 'nullable:posts,id',
            'sorting' => 'integer',
            'logo_image.upload' => 'image',
            'figma_image.upload' => 'image',
            'figma_file.upload' => 'file',
            'images.upload.*' => 'image',
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
            'logo_image.upload.*' => 'Логотип должен быть картинкой',
            'images.upload.*' => 'К загрузке доступны только изображения',
        ];
    }
}
