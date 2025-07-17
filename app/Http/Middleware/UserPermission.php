<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user->role == "attendant") {
            return redirect('/attendance/dashboards-attendance');
        }else if ($user->role ==  'teachers'){
            return redirect('/teacher-dashboard');
        }else if ($user->role ==  'student'){
            return redirect('/dahhboard-student-account');
        }
        return $next($request);
    }
}
