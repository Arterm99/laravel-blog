<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|file',
            'main_image' => 'required|file',
            // exists:categories сверяет поступающие данные категорий с даннми в таблице categories по id
            'category_id' => 'required|integer|exists:categories,id',

            // nullable - может и не придти
            'tag_ids' => 'nullable|array',
            // .* - все что внутри тэга должно пройти соответствующую валидацию
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }
}
