<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\EmailCheck;
use App\User;

class ProfileRequest extends FormRequest
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
          'username' => [
                  'required',
                  'max:20',
                  'string',
                  Rule::unique('users')->ignore($this->user()->id),
              ],
            'email' => [
                    'required',
                    'email',
                    'max:255',
                    new EmailCheck,
                  Rule::unique('users')->ignore($this->user()->id),
                ],
            'introduction' => 'required|string|max:200',
            'pic' => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}