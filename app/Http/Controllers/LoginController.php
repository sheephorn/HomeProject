<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // protected $loginService;

    public function __construct()
    {
        // $this->loginService = app('LoginService');
    }

    public function getLoginPage(Request $request)
    {
        return view('test');
    }

    public function login(Request $request)
    {
        $let = $this->loginService->login($request);
        return view('test');
    }
}
