<?php

namespace App\Http\Middleware;

use Closure;
use Redis;

class SingleUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 读取用户的单用户登录 cookie
        $singleToken = request()->cookie('SINGLE_USER_LOGIN');
        if ( !$singleToken) {
            auth()->logout();

            return redirect('/login');
        }

        $key = 'blog:single_user_login_' . user()->id;
        if (Redis::exists($key)) {
            // 获取 Redis 中的存储的时间
            $redisTime = Redis::get($key);
            $secret = md5(request()->getClientIp() . user()->id . $redisTime);
            // 重新加密后 判断是否和 cookie 中的值相等, 如果不等, 就退出登录, 跳转到登录页面
            if ($singleToken != $secret) {
                auth()->logout();
                // 记录此次异常登录记录
//                \DB::table('data_login_exception')->insert(['user_id' => auth()->id, 'ip' => request()->getClientIp(), 'created_at' => time()]);

                flashy()->error('您的帐号已在另一个地点登录...');

                return view('/login');
            }

            return $next($request);
        } else {
            auth()->logout();

            return redirect('login');
        }
    }
}
