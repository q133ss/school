<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StudentController\CommentRequest;
use App\Services\Teacher\CommentService;
use App\Services\Teacher\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return (new StudentService())->index();
    }

    public function comment(int $student_id, CommentRequest $request)
    {
        return (new CommentService())->comment($student_id, $request);
    }
}
