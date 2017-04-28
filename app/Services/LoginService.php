<?php

namespace App\Services;

use App\Repositories\MMemberRepository;

class LoginService
{
    protected $mMemberRepository;

    public function __counstruct(
        MMemberRepository $mMemberRepository
        )
    {
        $this->mMemberRepository = $mMemberRepository;
    }

    public function login($condition)
    {
        $user = $this->mMemberRepository->getUserLoginInfo($condition->email);
        if (isset($user)) {
            if (password_verify($condition['password'], $user->password)) {
                $convertedUser = json_decode(json_encode($user), true);
                $this->addUserSession($convertedUser);
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ok'),
                    'message' => '',
                    'accessTime' => getAccessTime(),
                    'ret' => false,
                ];
            } else {
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ng'),
                    'message' => app('MessageCreater')->getLoginMessage('not_match'),
                    'accessTime' => getAccessTime(),
                    'ret' => false,
                ];
            }
        } else {
            $ret = [
                'code' => app('CodeCreater')->getResponseCode('ng'),
                'message' => app('MessageCreater')->getLoginMessage('not_found'),
                'accessTime' => getAccessTime(),
                'ret' => false,
            ];
        }
        return $ret;
    }

    /**
     * ログインセッションを発行する
     * @param Array $user 付与するユーザー情報配列
     */
    private function addUserSession($user)
    {
        $convertedUser = json_decode(json_encode($user), true);
        session(['user' => $user]);
        return true;
    }

    /**
     * ユーザーを新規登録する
     * @param  Object $condition Request
     * @return Array            結果コードを含む配列
     */
    public function regist($condition)
    {
        $user = $this->mMemberRepository->getUserLoginInfo($condition->email);
        if (!isset($user)) {
            $info = [
                'first_name' => '',
                'last_name' => '',
                'birth_date' => '',
                'home_id' => '',
                'email' => $condition->email,
                'password' => password_hash($condition->password),
                'post_code' => '',
                'prefecture_id' => '',
                'prefecture_name' => '',
                'address' => '',
            ];
            $result = $this->mMemberRepository->save(['member_id' => 'new'], $info);
            $ret = [
                'code' => app('CodeCreater')->getResponseCode('ok'),
                'message' => '',
                'accessTime' => getAccessTime(),
            ];
        } else {
            $ret = [
                'code' => app('CodeCreater')->getResponseCode('ng'),
                'message' => app('MessageCreater')->getLoginMessage('already_exists'),
                'accessTime' => getAccessTime(),
            ];
        }
        return $ret;
    }
}
