<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StudentController\CommentRequest;
use App\Http\Requests\Teacher\StudentController\HomeworkRequest;
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

    public function homework(HomeworkRequest $request)
    {
        return (new StudentService())->homework($request);
    }

    public function homeworkUpdate(int $id, HomeworkRequest $request)
    {
        return (new StudentService())->homeworkUpdate($id, $request);
    }

    public function homeworkDelete(int $id)
    {
        return (new StudentService())->homeworkDelete($id);
    }
}
