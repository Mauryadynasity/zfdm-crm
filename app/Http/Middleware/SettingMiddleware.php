<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class SettingMiddleware
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
        $setting = Setting::first();
		if (!$setting) {
			return redirect('admin/setting')->with('fail','Please save the settings first.');
		}
        return $next($request);
    }
}
