<?php

namespace App\Http\Requests\Teacher\LessonController;

use Closure;
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
            'date'        => 'required|date_format:Y-m-d',
            'time'        => 'required|date_format:H:i',
            'price'       => 'required|integer',
            'duration'    => 'required|date_format:H:i',
            'description' => 'required|string|max:255',
            'student_id'  => [
                'required',
                function(string $attribute, mixed $value, Closure $fail): void
                {
                    $user = Auth()->guard('sanctum')->user();
                    if(!$user->isStudent($value)){
                        $fail('Выбран неверный ученик');
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'date.required'    => 'Выберите дату',
            'date.date_format' => 'Неверный формат даты',

            'time.required'    => 'Выберите время',
            'time.date_format' => 'Неверный формат времени',

            'price.required' => 'Укажите цену',
            'price.integer'  => 'Неверный формат цены',

            'duration.required'    => 'Укажите продолжительность',
            'duration.date_format' => 'Неверный формат продолжительности',

            'description.required' => 'Введите описание',
            'description.string'   => 'Описание должно быть строкой',
            'description.max'      => 'Описание не должно превышать 255 символов',

            'student_id.required' => 'Выберите ученика',
        ];
    }
}
