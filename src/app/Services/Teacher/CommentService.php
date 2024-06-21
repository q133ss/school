<?php

namespace App\Services\Teacher;

use App\Http\Requests\Teacher\StudentController\CommentRequest;
use App\Models\StudentComment;
use Illuminate\Support\Facades\DB;

class CommentService
{
    public function comment(int $student_id, CommentRequest $request): \Illuminate\Http\JsonResponse
    {
        $teacher_id = Auth()->guard('sanctum')->id();

        $isStudent = DB::table('student_teacher')
            ->where('teacher_id', $teacher_id)
            ->where('student_id', $student_id)
            ->exists();

        if(!$isStudent){
            abort(403, 'Указан неверный ученик');
        }

        $comment = StudentComment::where('student_id', $student_id)
            ->where('teacher_id', $teacher_id);
        if($comment->exists()){
            $comment = $comment->first();
            $comment->comment = $request->comment;
            $comment->save();
        }else{
            $comment = StudentComment::create([
                'student_id' => $student_id,
                'teacher_id' => $teacher_id,
                'comment'    => $request->comment
            ]);
        }

        return Response()->json([
            'message' => 'true',
            'comment' => $comment
        ]);
    }
}
