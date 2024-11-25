<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'ប្រព័ន្ធ កំពុងដំណើរការ...... !'
                ], 403);
            }
    
            return redirect()->back()->with('error', 'ប្រព័ន្ធ កំពុងដំណើរការ......!');

    
        return $next($request);
    }
}
