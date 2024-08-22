<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeviceDetectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();

        if ($agent->isDesktop()) {
            $request->session()->put('deviceType', 'desktop');
        } elseif ($agent->isTablet()) {
            $request->session()->put('deviceType', 'tablet');
        } else {
            $request->session()->put('deviceType', 'mobile');
        }

        if (!$agent->isDesktop()) {
            $request->session()->put('isMobile', true);
        } else {
            $request->session()->put('isMobile', false);
        }

        return $next($request);
    }
}
