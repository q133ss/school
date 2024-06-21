<?php

namespace App\Services\Teacher;

use App\Models\User;

class StudentService
{
    public function index()
    {
        $students = User::leftJoin('student_teacher', 'student_teacher.student_id', 'users.id')
            ->where('student_teacher.teacher_id', Auth()->guard('sanctum')->id())
            ->leftJoin('student_comments', 'student_comments.student_id', 'users.id')
            ->select('users.*', 'student_comments.comment')
            ->get();
        return $students;
    }
}
