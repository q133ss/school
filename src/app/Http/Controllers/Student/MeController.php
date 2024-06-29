<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function me()
    {
        return Auth()->guard('sanctum')->user()->load('studentLessons');
    }

    public function homeworks()
    {
        return Auth()->guard('sanctum')->user()->studentHomeworks;
    }
}
