<?php

namespace App\Services;

use App\Repositories\MMemberRepository;

class LoginService
{
    protected $mMemberRepository;

    public function __construct(
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
     * ユーザーを簡易新規登録する
     * @param  Object $condition Request
     * @return Array            結果コードを含む配列
     */
    public function easyRegist($condition)
    {
        $user = $this->mMemberRepository->getUserLoginInfo($condition->email);
        if (!isset($user)) {
            $info = [
                'first_name' => '',
                'last_name' => '',
                'birth_date' => getCurrentDateTimeobject()->format('Y-m-d'),
                'home_id' => '0',
                'email' => $condition->email,
                'password' => password_hash($condition->password, PASSWORD_DEFAULT),
                'post_code' => '0',
                'prefecture_id' => '0',
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
