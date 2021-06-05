<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        return  [
            'login' => 'required|unique:users|regex:/^[A-z]+$/i',
            'password' => 'required|min:9',
            'name' => 'required',
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Логин является обязательным',
            'login.unique' => 'Такой логин уже существует',
            'login.regex' => 'Логин может принимать только буквы латинского алфавита',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать не менее 9 символов',
            'name.required' => 'ФИО обязателен для заполнения',
            'email.required' => 'Электроная почта обязателен для заполнения',
            'email.email' => 'Электроная почта должна быть ввалидна',
        ];
    }
}
