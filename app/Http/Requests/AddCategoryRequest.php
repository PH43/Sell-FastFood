<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories|max:20|min:2'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được trống',
            'name.unique' => 'Tên danh mục đã có',
            'name.max' => 'Tên danh mục không được dài hơn 20 ký tự',
            'name.min' => 'Tên danh mục không được ngắn hơn 2 ký tự',
        ];
    }
}
