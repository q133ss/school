<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function register(array $data): \Illuminate\Http\JsonResponse
    {
        $data['role_id'] = Role::where('slug', 'student')->pluck('id')->first();
        $data['target'] = json_encode($data['target']);
        $user = User::create($data);
        $token = $user->createToken('web');

        DB::table('student_teacher')->insert([
            'teacher_id' => $data['teacher_id'],
            'student_id' => $user->id
        ]);

        return Response()->json(['user' => $user, 'token' => $token->plainTextToken]);
    }

    public function login(array $data): \Illuminate\Http\JsonResponse
    {
        $user = User::where('phone', $data['phone'])->first();
        $token = $user->createToken('web');
        return Response()->json(['user' => $user, 'token' => $token->plainTextToken]);
    }

    public function teachers()
    {
        return User::where('role_id', Role::where('slug', 'teacher')->pluck('id')->first())->get();
    }
}
