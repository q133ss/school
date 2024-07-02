<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormController\StoreRequest;
use App\Services\FormService;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function form(StoreRequest $request)
    {
        return (new FormService())->form($request);
    }
}
