<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|unique:products|max:100|min:2',
            'price' => 'required|numeric',
            'feature_image_path' => 'required',
            'image_path' => 'required',
            'contents' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được trống',
            'name.unique' => 'Tên sản phẩm đã có',
            'name.max' => 'Tên sản phẩm không được dài hơn 100 ký tự',
            'name.min' => 'Tên sản phẩm không được ngắn hơn 2 ký tự',
            'price.required' => 'Giá không được trống',
            'price.max' => 'Giá phải nhỏ hơn 10 triệu VNĐ ',
            'price.min' => 'Giá phải lớn hơn 1000 VNĐ',
            'price.numeric' => 'Giá phải là số',
            'feature_image_path.required' => 'Ẩnh đại diện không được trống',
            'image_path.required' => 'Ẩnh chi tiết không được trống',
            'contents.required' => 'Mô tả không được trống',
        ];
    }
}
