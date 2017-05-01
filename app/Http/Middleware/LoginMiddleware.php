<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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
        // セッションにユーザー情報が持っていなかったらログインページにリダイレクとさせる
        // ユーザー情報はログイン時に付与される
        // RequestがAjaxだった場合はResponseを返し、ログアウトのリダイレクト先を渡す
        if (!$request->session()->has('user')) {
            if($request->ajax()) {
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ng'),
                    'message' => app('MessageCreater')->getLoginMiddlewareMessage('ajax'),
                    'accessTime' => getAccessTime(),
                    'action' => route('LOGOUT'),
                ];
            } else {
                $ret = redirect()->route('LOGOUT');
            }

        }
        if (!isset($ret)) {
            $ret = $next($request);
        }
        return $ret;
    }
}
