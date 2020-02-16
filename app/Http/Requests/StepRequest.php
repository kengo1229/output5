<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepRequest extends FormRequest
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
     *親step新規登録時のバリデーション
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:40',
            'category_id' => 'not_in: 0',
            'goal_time' => 'required|integer|min:1|max:10000',
            'description' => 'required|string|max:200',
            'step0' => 'required|string|max:40',
            'todo0' => 'required|string|max:100',
            'step1' => 'required|string|max:40',
            'todo1' => 'required|string|max:100',
            'step2' => 'required|string|max:40',
            'todo2' => 'required|string|max:100',
            'step3' => 'required|string|max:40',
            'todo3' => 'required|string|max:100',
            'step4' => 'required|string|max:40',
            'todo4' => 'required|string|max:100',
            'pic' => 'file|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
