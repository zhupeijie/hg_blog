<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RecordLastActivedTime
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
        if (Auth::check()) {
            // 如果是登录用户  记录最后登录时间
            Auth::user()->recordLastActivedAt();
        }

        return $next($request);
    }
}
