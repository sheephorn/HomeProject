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
     * 指定emailで登録しているuserを取得する
     * 取得したパラメータすべてをログイン時のSessionに保持する
     * @param  String $email 登録済みEmail
     * @return Object        Userレコード
     */
    public function getUserLoginInfo($email)
    {
        $select = [
            'email',
            'password',
            'member_id',
        ];
        return $this->model
                ->where('email', $email)
                ->select($select)
                ->first();
    }
}
