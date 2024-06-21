<?php

namespace App\Http\Requests\Teacher\StudentController;

use App\Models\Lesson;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class HomeworkRequest extends FormRequest
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
        $user = Auth()->guard('sanctum')->user();
        return [
            'student_id' => [
                'required',
                function(string $attribute, mixed $value, Closure $fail) use ($user) : void
                {
                    if(!$user->isStudent($value)){
                        $fail('Указан неверный ученик');
                    }
                }
            ],
            'lesson_id'  => [
                'required',
                function(string $attribute, mixed $value, Closure $fail) use ($user) : void
                {
                    $lesson = Lesson::where('id', $value);
                    if(!$lesson->exists()
                        || $lesson->pluck('student_id')->first() != $this->student_id
                        || $lesson->pluck('teacher_id')->first() != $user->id)
                    {
                        $fail('Выбран неверный предмет');
                    }
                }
            ],
            'task'       => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Выберите ученика',
            'lesson_id.required'  => 'Выберите урок',
            'task.required'       => 'Введите задание',
            'task.string'         => 'Задание должно быть строкой'
        ];
    }
}
