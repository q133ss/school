<?php

namespace App\Services\Teacher;

use App\Http\Requests\Teacher\StudentController\HomeworkRequest;
use App\Http\Requests\Teacher\StudentController\UpdateRequest;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public function index()
    {
        $students = User::leftJoin('student_teacher', 'student_teacher.student_id', 'users.id')
            ->where('student_teacher.teacher_id', Auth()->guard('sanctum')->id())
            ->leftJoin('student_comments', 'student_comments.student_id', 'users.id')
            ->select('users.*', 'student_comments.comment')
            ->with('homework')
            ->get();
        return $students;
    }

    public function homework(HomeworkRequest $request)
    {
        $data = $request->validated();
        $data['teacher_id'] = Auth()->guard('sanctum')->id();

        $homework = Homework::create($data);
        return Response()->json([
            'message'  => 'true',
            'homework' => $homework
        ]);
    }

    public function homeworkUpdate(int $id, HomeworkRequest $request)
    {
        $homework = Homework::findOrFail($id);
        if($homework->teacher_id != Auth()->guard('sanctum')->id()){
            abort(403, 'У вас нет прав');
        }
        $data = $request->validated();
        $newHomework = $homework->update($data);
        return Response()->json([
            'message'  => 'true',
            'homework' => $homework
        ]);
    }

    public function homeworkDelete(int $id)
    {
        $homework = Homework::findOrFail($id);
        if($homework->teacher_id != Auth()->guard('sanctum')->id()){
            abort(403, 'У вас нет прав');
        }
        $homework->delete();
        return Response()->json([
            'message'  => 'true'
        ]);
    }

    public function update(int $id, UpdateRequest $request)
    {
        $user = User::findOrFail($id);
        $check = DB::table('student_teacher')
            ->where('teacher_id', Auth()->guard('sanctum')->id())
            ->where('student_id', $id)
            ->exists();

        if($check){
            $update = $user->update($request->validated());
            return Response()->json([
                'message'  => 'true',
                'user'     => $user
            ]);
        }
        abort(403, 'У вас нет прав');
    }
}
