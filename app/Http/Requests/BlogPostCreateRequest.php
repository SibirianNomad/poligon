<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title'         => 'required|min:5|max:200|unique:blog_posts',
            'slug'          => 'max:208',
            'content_raw'   => 'required|string|min:5|max:10000',
            //полученное значение category_id сразу система будет искать в таблице blog_categories в колонке id
            'category_id'   => 'required|integer|exists:blog_categories,id',
            'except'        => 'max:500'
        ];
    }
    public function messages(){
        return[
            'title.required'    => 'введите заголовок статьи',
            'title.unique'      => 'Такой заголовок уже существует',
            'content_raw.min'   => 'Минимальная длина статьи [:min] символов'
        ];
    }
    public function attributes()
    {
        return ['title'=>'Заголовок'];
    }
}
