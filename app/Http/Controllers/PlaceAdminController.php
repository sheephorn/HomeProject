<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlaceAdminService;

/**
 * class PlaceAdminController
 * 場所のマスタ管理系コントローラー
 */
class PlaceAdminController extends BaseController
{
    protected $placeAdminService;

    public function __construct(
        PlaceAdminService $placeAdminService
        )
        {
            $this->placeAdminService = $placeAdminService;
        }

    public function getPage(Request $request)
    {
        $ret = $this->placeAdminService->getPage($request);
        return view('page.placeAdmin');
    }

    public function addGroup(Request $request)
    {
        $ret = $this->placeAdminService->addGroup($request);
        return $ret;
    }

    public function addPlace(Request $request)
    {
        $ret = $this->placeAdminService->addPlace($request);
        return $ret;
    }
}
