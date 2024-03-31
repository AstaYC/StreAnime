<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role_route;
use Illuminate\Support\Facades\DB;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next): Response
    {
        $uri = '/'.$request->route()->uri;
        $role_id = session('role_id') ?? '';
        if ($role_id) {
            $allowedRoutes = Role_route::where('role_id', $role_id)->get();
            foreach ($allowedRoutes as $route) {
                $allowedUri = $route->route->nom;
                if (count(explode('/', $uri)) > 2) {
                    if (strstr($uri, $allowedUri))  return $next($request);
                } else {
                    if ($uri === $allowedUri) return $next($request);
                }
            }
            return abort(401);
        } else return redirect('/login');
    }
}    