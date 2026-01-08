<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek token dari session
        $token = session('api_token');

        // Kalau kosong, coba dari cookie
        if (!$token && $request->hasCookie('api_token')) {
            $token = $request->cookie('api_token');

            // Jika ada di cookie, simpan ke session biar konsisten
            session(['api_token' => $token]);

            if ($request->hasCookie('user')) {
                session(['user' => json_decode($request->cookie('user'), true)]);
            }
        }

        // Kalau tetap tidak ada token, berarti belum login
        if (!$token) {
            return redirect()->route('login.form')->with('login', 'Silakan login terlebih dahulu');
        }

        // Kalau ada token, lanjutkan request
        return $next($request);
    }
}
