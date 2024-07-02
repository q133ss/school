<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsersController\StoreRequest;
use App\Http\Requests\Admin\UsersController\UpdateRequest;
use App\Models\User;
use App\Services\Admin\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return User::where('id', '!=', Auth()->guard('sanctum')->id())
            ->withFilter($request)
            ->with('studentLessons')
            ->withCount('studentLessons')
            ->with('teacherLessons')
            ->withCount('teacherLessons')
            ->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return (new UsersService())->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id)->load('students', 'homework');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return (new UsersService())->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return (new UsersService())->delete($id);
    }
}
