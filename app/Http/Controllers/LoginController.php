<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Http\Requests\EasyUserRegistRequest;

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

    public function getDashboardPage(Request $request)
    {
        return view('page.dashboard');
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
            $returnable =  redirect()->route('GET_DASHBOARD');
        } else {
            $returnable = view('page.login', ['message' => $ret['message']]);
        }
        return $returnable;
    }

    /**
     * メンバーの新規追加
     * @param  Object $request Request
     * @return Array           結果コード等含む配列
     */
    public function easyRegist(EasyUserRegistRequest $request)
    {
        $ret = $this->loginService->easyRegist($request);
        $returnable = view('page.login', ['message' => $ret['message']]);
        return $returnable;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('LOGIN_VIEW');
    }
}
