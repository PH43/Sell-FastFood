<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:100|min:2',
            'price' => 'required|max:7|min:4',
            'contents' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được trống',
            'name.max' => 'Tên sản phẩm không được dài hơn 100 ký tự',
            'name.min' => 'Tên sản phẩm không được ngắn hơn 2 ký tự',
            'price.required' => 'Giá không được trống',
            'price.max' => 'Giá phải nhỏ hơn 10 triệu VNĐ ',
            'price.min' => 'Giá phải lớn hơn 1000 VNĐ',
            'contents.required' => 'Mô tả không được trống',
        ];
    }
}
