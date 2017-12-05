<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
            'name'         => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/',
            'email'        => 'required|email|unique:users,email,' . Auth::id(),
            'introduction' => 'max:80',
            'avatar'       => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];
    }

    public function messages()
    {
        return [
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
            'name.regex'        => '昵称只支持中英文、数字、横杆和下划线。',
            'name.between'      => '昵称必须介于 3 - 25 个字符之间。',
            'name.required'     => '昵称不能为空。',
            'email.unique'      => '该邮箱已存在。',
        ];
    }
}
