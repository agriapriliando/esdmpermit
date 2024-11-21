<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (!Auth::check())
            return redirect('login');
        $roles = explode('|', $roles);
        // dd($roles);
        $user = Auth::user();
        // if ($user->role == $roles) {
        //     session()->put($roles, true);
        //     return $next($request);
        // }
        if (in_array($user->role, $roles)) {
            session()->put($user->role, true);
            return $next($request);
        }
        return redirect('login')->with('error', 'Anda belum punya akses, silahkan cek email untuk aktivasi akun');
    }
}
