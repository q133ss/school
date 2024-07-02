<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\MeController\AvatarRequest;
use App\Services\Student\StudentService;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function me()
    {
        return (new StudentService())->me();
    }

    public function homeworks()
    {
        return Auth()->guard('sanctum')->user()->studentHomeworks;
    }

    public function getTg()
    {
        return (new StudentService())->getTg();
    }

    public function avatar(AvatarRequest $request)
    {
        return (new StudentService())->avatar($request);
    }
}
