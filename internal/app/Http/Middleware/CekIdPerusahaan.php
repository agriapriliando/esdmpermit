<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekIdPerusahaan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // cek session id_perusahaan
        if (!session()->has('id_perusahaan')) {
            return redirect()->route('home')
                ->with('error', 'Anda harus memilih perusahaan terlebih dahulu.');
        }

        return $next($request);
    }
}
