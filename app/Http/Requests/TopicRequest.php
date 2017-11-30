<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
            'title'       => 'required|min:1|max:196',
            'category_id' => 'required',
//            'labels' => 'required',
            'body'        => 'required',
        ];
    }

    /**
     * This is the tips for article form
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'  => '请输入标题',
            'title.min'       => '标题不能少于1个字符',
            'title.max'       => '标题不能多于196个字符',
            'labels.required' => '请选择标签',
            'body.required'   => '请输入内容',
        ];
    }
}