<?php

namespace App\Http\Requests\FormController;

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
            'name'  =>  'string|required',
            'phone' => 'required|regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/'
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'   => 'Имя должно быть строкой',
            'name.required' => 'Введите имя',

            'phone.required' => 'Введите телефон',
            'phone.regex'    => 'Номер телефона должен соответствовать формату +7(999)999-99-99',
        ];
    }
}
