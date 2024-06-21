<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\UsersController\StoreRequest;
use App\Http\Requests\Admin\UsersController\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    public function store(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        unset($data['password']);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        return Response()->json([
            'message' => 'true',
            'user'    => $user
        ]);
    }

    public function update(int $id, UpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        unset($data['password']);
        if($request->password != null) {
            $data['password'] = Hash::make($request->password);
        }

        $user = User::findOrFail($id);
        $updateUser = $user->update($data);

        return Response()->json([
            'message' => 'true',
            'user'    => $user
        ]);
    }

    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            DB::table('student_teacher')->where('student_id', $id)->delete();
            DB::table('student_comments')->where('student_id', $id)->delete();
            DB::table('homework')->where('student_id', $id)->delete();
            DB::table('lessons')->where('student_id', $id)->delete();
            $user->delete();

            DB::commit();

            return Response()->json([
                'message' => 'true'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
