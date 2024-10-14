<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $roles = explode('|', $role);

        foreach ($roles as $role_name) {
            if (Auth::check() && Auth::user()->hasRole($role_name)) {
                return $next($request);
            }
        }

        $message = [
            'alert-type' => 'error',
            'message' => 'Maaf, Anda tidak memiliki akses untuk melakukan ini.'
        ];

        return redirect()->back()->with($message);
    }
}
