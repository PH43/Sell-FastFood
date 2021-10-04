<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserAdminRequest extends FormRequest
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
            'name' => 'required|unique:users|max:20|min:2',
            'email' => 'required|unique:users',
            'password' => 'required|max:20|min:4',
            'role_id' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được trống',
            'name.unique' => 'Tên đã có',
            'name.max' => 'Tên không được dài hơn 20 ký tự',
            'name.min' => 'Tên không được ngắn hơn 2 ký tự',
            'email.required' => 'Email không được trống',
            'email.unique' => 'Email đã có',
            'password.required' => 'Mật khẩu không được trống',
            'password.max' => 'Mật khẩu phải ngắn hơn 20 ký tự ',
            'password.min' => 'Mật khẩu phải dài hơn 4 ký tự',
            'role_id.required' => 'Chức vụ không được trống',
            'address.required' => 'Địa chỉ không được trống',
            'phone.required' => 'Số điện thoại không được trống',
            'phone.numeric' => 'Số điện thoại phải là số',
        ];
    }
}
