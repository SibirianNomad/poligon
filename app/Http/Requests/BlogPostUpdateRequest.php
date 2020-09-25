<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|min:5|max:200',
            'slug'          => 'max:208',
            'content_raw'   => 'required|string|min:5|max:10000',
            //полученное значение category_id сразу система будет искать в таблице blog_categories в колонке id
            'category_id'   => 'required|integer|exists:blog_categories,id',
            'except'        => 'max:500'
        ];
    }
}
