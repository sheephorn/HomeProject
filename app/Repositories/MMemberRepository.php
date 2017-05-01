<?php

namespace App\Repositories;

use App\Repositories\Eloquent\m_members;

class MMemberRepository extends BaseRepository
{
    protected $model;

    public function __construct(m_members $m_members)
    {
        $this->model = $m_members;
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
