<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthController\LoginRequest;
use App\Http\Requests\AuthController\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return (new AuthService())->register($request->validated());
    }

    public function login(LoginRequest $request)
    {
        return (new AuthService())->login($request->validated());
    }

    public function teachers()
    {
        return (new AuthService())->teachers();
    }
}
