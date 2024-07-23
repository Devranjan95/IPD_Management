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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission)
    {
        $permissions = session('permissions', []);

        if (!in_array($permission, $permissions)) {
            // Optionally, you can redirect the user or show an error page
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
