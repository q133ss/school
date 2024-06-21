<?php

namespace App\Services\Teacher;

use App\Http\Requests\Teacher\LessonController\StoreRequest;
use App\Models\Lesson;

class LessonService
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['teacher_id'] = Auth()->guard('sanctum')->id();
        $lesson = Lesson::create($data);
        return Response()->json([
            'message' => 'true',
            'lesson'  => $lesson
        ]);
    }

    public function show(int $id)
    {
        $lesson = Lesson::findOrFail($id);
        if($lesson->teacher_id != Auth()->guard('sanctum')->id()){
            abort(403, 'Указан неверный урок');
        }

        return Response()->json([
            'lesson'  => $lesson
        ]);
    }

    public function update(int $id, StoreRequest $request)
    {
        $lesson = Lesson::findOrFail($id);
        if($lesson->teacher_id != Auth()->guard('sanctum')->id()){
            abort(403, 'Указан неверный урок');
        }

        $data = $request->validated();
        $newLesson = $lesson->update($data);

        return Response()->json([
            'message' => 'true',
            'lesson'  => $lesson
        ]);
    }

    public function delete(int $id)
    {
        $lesson = Lesson::findOrFail($id);
        if($lesson->teacher_id != Auth()->guard('sanctum')->id()){
            abort(403, 'Указан неверный урок');
        }

        $lesson->delete();

        return Response()->json([
            'message'  => true
        ]);
    }
}
