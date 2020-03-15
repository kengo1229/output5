<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;

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
     *親step新規登録・編集時のバリデーション
     *stepとtodoについて最初だけを入力必須にして、残りは任意入力にする
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
            'step1' => 'nullable|string|max:40',
            'todo1' => 'nullable|string|max:100',
            'step2' => 'nullable|string|max:40',
            'todo2' => 'nullable|string|max:100',
            'step3' => 'nullable|string|max:40',
            'todo3' => 'nullable|string|max:100',
            'step4' => 'nullable|string|max:40',
            'todo4' => 'nullable|string|max:100',
            'pic' => 'file|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    /**
     *stepとtodoについて最初だけを入力必須にして、残りは任意入力にしているが
     *stepだけ入力してtodoの入力がない、又は逆のパターン、そして前の項目を飛ばして入力している場合
     *入力必須にする。
    */
    public function withValidator(Validator $validator)
    {
        $validator->sometimes('step1', 'required|string|max:40', function ($input) {
            return $input->todo1 != null || $input->todo2 != null || $input->step2 != null
            || $input->todo3 != null || $input->step3 != null || $input->todo4 != null || $input->step4 != null;
        });

        $validator->sometimes('todo1', 'required|string|max:100', function ($input) {
            return $input->step1 != null || $input->todo2 != null || $input->step2 != null
            || $input->todo3 != null || $input->step3 != null || $input->todo4 != null || $input->step4 != null;
        });

        $validator->sometimes('step2', 'required|string|max:40', function ($input) {
            return $input->todo2 != null || $input->todo3 != null || $input->step3 != null
            || $input->todo4 != null || $input->step4 != null;
        });

        $validator->sometimes('todo2', 'required|string|max:100', function ($input) {
            return $input->step2 != null || $input->todo3 != null || $input->step3 != null
            || $input->todo4 != null || $input->step4 != null;
        });

        $validator->sometimes('step3', 'required|string|max:40', function ($input) {
            return $input->todo3 != null || $input->todo4 != null || $input->step4 != null;
        });

        $validator->sometimes('todo3', 'required|string|max:100', function ($input) {
            return $input->step3 != null || $input->todo4 != null || $input->step4 != null;
        });

        $validator->sometimes('step4', 'required|string|max:40', function ($input) {
            return $input->todo4 != null;
        });

        $validator->sometimes('todo4', 'required|string|max:100', function ($input) {
            return $input->step4 != null;
        });

    }

}
