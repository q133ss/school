<?php

namespace App\Services\Student;

use App\Http\Requests\Student\MeController\AvatarRequest;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    public function me()
    {
        $user = Auth()->guard('sanctum')->user()->load('studentLessons');
        $lessonsCount = $user->studentLessons->count();
        $avatar = $user->avatar;
        $user['lessonsCount'] = $lessonsCount;
        $user['avatar'] = $avatar;

        return $user;
    }
    public function getTg()
    {
        $id = Auth()->guard('sanctum')->id();
        $tg = DB::table('student_teacher')
            ->where('student_id', $id)
            ->leftJoin('users', 'users.id', 'student_teacher.teacher_id')
            ->pluck('users.telegram')
            ->first();

        return Response()->json([
            'tg' => $tg
        ]);
    }

    public function avatar(AvatarRequest $request)
    {

        $check = File::where('fileable_id', Auth()->guard('sanctum')->id())
            ->where('fileable_type', 'App\Models\User')
            ->where('category', 'avatar');

        if($check->exists()){
            $full_path = $check->pluck('src')->first();
            $path = str_replace(env('APP_URL').'/storage/','', $full_path);
            Storage::disk('public')->delete($path);
            $check->delete();
        }

        return File::create([
            'fileable_id'   => Auth()->guard('sanctum')->id(),
            'fileable_type' => 'App\Models\User',
            'src'           => env('APP_URL').'/storage/'.$request->file('avatar')->store('avatars', 'public'),
            'category'      => 'avatar'
        ]);
    }
}
