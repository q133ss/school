<?php

namespace App\Http\Requests\AuthController;

use App\Models\User;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
            'phone'    => [
                'required',
                'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
            ],
            'password' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail): void
                {
                    $user = User::where('phone', $this->phone);
                    if(!$user->exists() || !Hash::check($value, $user->pluck('password')->first())){
                        $fail('Неверный телефон или пароль');
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Введите телефон',
            'phone.regex'    => 'Неверный формат телефона',

            'password.required'  => 'Укажите пароль',
            'password.string'    => 'Поле пароль должно быть строкой'
        ];
    }
}
