<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (array_key_exists($lang, config('app.languages'))) {
                App::setLocale($lang);
                Session::put('locale', $lang);
                if ($lang == 'bg') {
                    Session::put('langId', 1);
                } else {
                    Session::put('langId', 2);
                }
            }
        } elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
