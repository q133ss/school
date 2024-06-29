<?php

namespace App\Http\Requests\Teacher\StudentController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'avg_rate_current'   => 'nullable|string',
            'month_name_current' => 'nullable|string',
            'avg_rate_last'      => 'nullable|string',
            'month_name_last'    => 'nullable|string',
            'percent'            => 'nullable|string',
            'main_course'        => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'avg_rate_current.string'   => 'Средняя оценка за текущий месяц должна быть строкой',
            'month_name_current.string' => 'Название текущего месяца должно быть строкой',
            'avg_rate_last.string'      => 'Средняя оценка за прошлый месяц должна быть строкой',
            'month_name_last.string'    => 'Название прошлого месяца должно быть строкой',
            'percent.string'            => 'Процент показателей должен быть строкой',
            'main_course.string'        => 'Название основного курса должно быть строкой'
        ];
    }
}
