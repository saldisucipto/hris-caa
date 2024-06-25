<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia;

class DisableInertia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if (in_array($request->route()->uri(), ['/hris/laporan/laporan-karyawan'])) {
            $request->inertia = false;
        }

        return $next($request);
    }
}
