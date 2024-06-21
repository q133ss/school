<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\LessonController\StoreRequest;
use App\Services\Teacher\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Auth()->guard('sanctum')->user()->teacherLessons;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return (new LessonService())->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return (new LessonService())->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        return (new LessonService())->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return (new LessonService())->delete($id);
    }
}
