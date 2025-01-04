<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class LimitLoginAttempts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip(); // Use the user's IP address as a unique identifier
        $key = 'login_attempts_' . $ipAddress;

        // Retrieve login attempts from cache (default is 0)
        $attempts = Cache::get($key, 0);

        if ($attempts >= 3) {
            return Redirect::route('login.blocked')->with('error', 'Too many login attempts. Please try again later.');
        }

        // Increment login attempts on every request
        Cache::put($key, $attempts + 1, now()->addMinutes(1)); // Expire in 5 minutes
        return $next($request);
    }
}
