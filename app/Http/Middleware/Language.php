<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = Session::get('applocale');
        if(!$locale){
            $locale = 'en';
        }
        if (! in_array($locale, ['en', 'gm'])) {
            abort(400);
        }
        App::setLocale($locale);
       return $next($request);
    }
}
