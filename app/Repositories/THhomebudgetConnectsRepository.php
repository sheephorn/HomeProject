<?php

namespace App\Repositories;

use App\Repositories\Eloquent\t_homebudget_connects;

class THhomebudgetConnectsRepository extends BaseRepository
{
    protected $model;

    public function __construct(t_homebudget_connects $t_homebudget_connects)
    {
        $this->model = $t_homebudget_connects;
    }

    /**
     * 家計一覧を返す
     * @param  Int $memberId メンバーid
     * @return Object           家計一覧リスト
     */
    public function getHomebudgetList($memberId)
    {
        $ret = $this->model
            ->leftjoin('m_homebudgets', 't_homebudget_connects.homebudget_id', '=', 'm_homebudgets.homebudget_id')
            ->where('t_homebudget_connects.member_id', $memberId)
            ->select('m_homebudgets.name', 'm_homebudgets.homebudget_id')
            ->get()
            ->pluck('name', 'homebudget_id')
            ;
        return $ret;
    }
}
