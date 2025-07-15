<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Harus login terlebih dahulu');
        }

        $user = Auth::user();

        // Cek apakah user memiliki role yang diperbolehkan
        if (!in_array($user->role->name, $roles)) {
            return abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
