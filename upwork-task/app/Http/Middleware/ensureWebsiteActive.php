<?php

namespace App\Http\Middleware;

use App\Models\setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ensureWebsiteActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $setting = setting::find(1);
        if($setting->online_status == true){
            return $next($request);
        }else{
            return redirect()->route('login')->withErrors('Website Currently Offline');
        }

    }
}
