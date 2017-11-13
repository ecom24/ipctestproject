<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'isbn' => 'isbn',
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'price' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'isbn.isbn' => 'Invalid ISBN',
            'title.required' => 'Title required',
            'author.required' => 'Author required',
            'category.required' => 'Category required',
            'price.required' => 'Price required',
        ];
    }
}
