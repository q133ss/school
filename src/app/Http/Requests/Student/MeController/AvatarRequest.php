<?php

namespace App\Http\Requests\Student\MeController;

use Illuminate\Foundation\Http\FormRequest;

class AvatarRequest extends FormRequest
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
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif'
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.image' => 'Аватар должен быть изображением',
            'avatar.mimes' => 'Поддерживаемые форматы: jpeg,jpg,png,gif'
        ];
    }
}
