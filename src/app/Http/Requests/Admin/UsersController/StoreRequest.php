<?php

namespace App\Http\Requests\Admin\UsersController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'phone'      => [
                'required',
                'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
                'unique:users,phone',
                'max:255'
            ],
            'password'   => 'required|string|min:8|max:255',
            'role_id'    => 'required|exists:roles,id',
            'lang'       => 'nullable|in:en,cn,es',
            'target'     => 'nullable|array',
            'target.*'   => 'nullable|string',
            'teacher_id' => 'nullable|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'name.string'   => 'Имя должно быть строкой',
            'name.max'      => 'Имя не должно быть больше 255 символов',

            'phone.required' => 'Введите телефон',
            'phone.string'   => 'Телефон должно быть строкой',
            'phone.regex'    => 'Неверный формат телефона',
            'phone.unique'   => 'Пользователь с таким телефоном уже существует',
            'phone.max'      => 'Телефон не должен быть больше 255 символов',

            'password.required'  => 'Укажите пароль',
            'password.max'       => 'Поле пароль не должно превышать 255 символов',
            'password.min'       => 'Поле пароль должно содержать не менее 8 символов',
            'password.string'    => 'Поле пароль должно быть строкой',

            'role_id.required' => 'Укажите роль',
            'role_id.exists'   => 'Указана неверная роль',

            'lang.in'       => 'Неверно указан язык',

            'target.array'    => 'Неверно выбрана цель',

            'teacher_id.exists'   => 'Указан неверный преподаватель'
        ];
    }
}
