<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
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
        if(Auth::guard('admin')->user()->role_id == 1){
            if (!$setting) {
                return redirect('admin/setting')->with('fail','Please save the settings detail first.');
            }
        }
        
        return $next($request);
    }
}
