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
