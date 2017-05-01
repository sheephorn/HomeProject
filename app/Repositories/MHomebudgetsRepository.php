<?php

namespace App\Repositories;

use App\Repositories\Eloquent\m_homebudgets;

class MHomebudgetsRepository extends BaseRepository
{
    protected $model;

    public function __construct(m_homebudgets $m_homebudgets)
    {
        $this->model = $m_homebudgets;
    }

    /**
     * 指定ユーザーが管理する家計一覧を取得する
     * @param  Int $memberId メンバーid
     * @param  String $name     家計名
     * @return Object           検索
     */
    public function findMyHomebudgetList($memberId)
    {
        $ret = $this->model
            ->leftjoin('m_members', 'm_homebudgets.manager_id', '=', 'm_members.member_id')
            ->where('m_homebudgets.manager_id', $memberId)
            ->lists('m_homebudgets.name', 'm_homebudgets.homebudgets_id');
        return $ret;
    }

    public function createQuery($condition)
    {
        $query = $this->getFromQuery($condition);
        $query = $this->getSelectQuery($condition, $query);
        $query = $this->getWhereQuery($condition, $query);
        $query = $this->orderByQuery($condition, $query);
        return $query;
    }

    protected function getFromQuery($condition)
    {
        $query = $this->model;
        return $query;
    }

    protected function getSelectQuery($condition, $query)
    {
        $selectArray = [
            '*',
        ];
        $query = $query->select($selectArray);
        return $query;
    }

    protected function getWhereQuery($condition, $query)
    {
        $query = $query
            ->where(function($tempQuery) use ($condition){
                $target = 'homebudgetName';
                if (isset($condition[$target]) && $condition[$target] !== '') {
                    $tempQuery->where('m_homebudgets.name', $condition[$target]);
                }
            })
            ->where(function($tempQuery) use ($condition){
                $target = 'managerId';
                if (isset($condition[$target]) && $condition[$target] !== '') {
                    $tempQuery->where('m_homebudgets.manager_id', $condition[$target]);
                }
            })
            ;
        return $query;
    }

    protected function orderByQuery($condition, $query)
    {
        $sortArray = [
            //
        ];
        $query = $this->orderBy($query, $condition, $sortArray);
        return $query;
    }


}
