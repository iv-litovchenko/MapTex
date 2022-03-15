<?php

namespace App\Http\Requests\Technologies;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string'
//            'logo_image' => 'file',
//            'parent_id' => 'integer|exists:technologies.id',
//            'tags_ids' => 'nullable|array',
//            'tags_ids.*' => 'nullable|integer|exists:technologies.id'
        ];
    }

    public function messeges()
    {
        return [
            'title.required' => 'Это поле обязательнго к заполнению'
        ];
    }
}
