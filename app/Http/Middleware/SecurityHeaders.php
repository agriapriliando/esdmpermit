<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    private $unwantedHeaders = ['X-Powered-By', 'server', 'Server'];

    /**
     * @param $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nonce = base64_encode(random_bytes(16)); // Generate nonce

        // Simpan nonce di request, bukan session
        $request->attributes->set('csp_nonce', $nonce);
        // simpan nonce di session
        session()->put('csp_nonce', $nonce);

        $this->removeUnwantedHeaders($this->unwantedHeaders);
        $response = $next($request);

        // Tambahkan nonce ke dalam Content-Security-Policy
        $csp = "default-src 'self'; " .
            "script-src 'self' 'nonce-{$nonce}' 'unsafe-eval' *.jsdelivr.net *.highcharts.com; " .
            "style-src 'self' *.jsdelivr.net 'nonce-{$nonce}'; " .
            "img-src 'self' * data:; " .
            "font-src 'self' *.jsdelivr.net data: ; " .
            "connect-src 'self' plausible.io/api/event cdn.jsdelivr.net; " .
            "media-src 'self'; " .
            "frame-src 'self' *.youtube.com *.vimeo.com; " .
            "object-src 'none'; " .
            "base-uri 'self';";
        $response->headers->remove('Content-Security-Policy');
        $response->headers->set('Content-Security-Policy', $csp);
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Expect-CT', 'enforce, max-age=30');
        $response->headers->set('Permissions-Policy', 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type,Authorization,X-Requested-With,X-CSRF-Token');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        // if (!app()->environment('testing')) {

        //     $this->removeUnwantedHeaders($this->unwantedHeaders);
        // }

        return $response;
    }

    /**
     * @param $headers
     */
    private function removeUnwantedHeaders($headers): void
    {
        foreach ($headers as $header) {
            header_remove($header);
        }
    }
}
