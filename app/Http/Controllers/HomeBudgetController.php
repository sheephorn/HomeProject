<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeBudgetService;

class HomeBudgetController extends BaseController
{
    protected $homeBudgetService;

    public function __construct(
        HomeBudgetService $homeBudgetService
        )
    {
        $this->homeBudgetService = $homeBudgetService;
    }

    /**
     * 家計マスタ　編集ページの表示
     * @param  Object $request Request
     * @return HTML           画面
     */
    public function getEditPage(Request $request)
    {
        $data = $this->homeBudgetService->getEditPage($request);
        \Log::debug($request->session()->get('user'));
        return view('page.homebudgetAdmin', compact('data', 'request'));
    }

    public function add(Request $request)
    {
        $data = $this->homeBudgetService->add();
        return $ret;
    }
}
