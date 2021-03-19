<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AuthCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $rName = $request->route()->getName();
        $permission = Permission::whereRaw("Find_IN_SET ('$rName', route)")->first();
        if ($permission) {
            if (!$request->user()->can($permission->name)) {
                abort(403);
            }
        }
        return $next($request);
    }
}
