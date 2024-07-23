<?php

// app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class Role_new_Middleware
{
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role_id;
        $roleDetails = Role::find($role);
       
        if ($roleDetails) {
            $permissions = explode(',', $roleDetails->permission);
            $actions = explode(',', $roleDetails->action);
            
            // Store permissions and actions in the session
            Session::put('permissions', $permissions);
            Session::put('actions', $actions);
        } else {
            // If roleDetails not found, clear session permissions and actions
            Session::forget('permissions');
            Session::forget('actions');
        }
    }

    // Debug: Ensure middleware is executing
    //dd('Middleware executed', session('permissions'), session('actions'));

    return $next($request);
}
}

