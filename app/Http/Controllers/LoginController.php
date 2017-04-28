<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginService;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(
        LoginService $loginService
        )
    {
        $this->loginService = $loginService;
    }

    /**
     * ログインページの表示
     * @param  Object $request Request
     * @return Html           ページ
     */
    public function getLoginPage(Request $request)
    {
        return view('page.login');
    }

    /**
     * ログイン処理
     * @param  Object $request Request
     * @return   Html           ページ
     */
    public function login(Request $request)
    {
        $ret = $this->loginService->login($request);
        if ($ret['ret']) {
            $returnable =  view('page.login');
        } else {
            $returnable = view('page.login', ['data' => $ret['data']]);
        }
        return $returnable;
    }

    /**
     * メンバーの新規追加
     * @param  Object $request Request
     * @return Array           結果コード等含む配列
     */
    public function regist(Request $request)
    {
        $ret = $this->loginService->regist($request);
        return $ret;
    }
}
