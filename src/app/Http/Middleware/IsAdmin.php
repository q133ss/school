<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = Auth()->guard('sanctum')->user()->role_id;
        if($role_id == Role::where('slug', 'admin')->pluck('id')->first()) {
            return $next($request);
        }
        abort(403, 'У вас недостаточно прав');
    }
}
