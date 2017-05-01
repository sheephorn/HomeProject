<?php

namespace App\Services;

use App\Repositories\MMembersRepository;

class LoginService extends BaseService
{
    protected $mMemberRepository;

    public function __construct(
        MMembersRepository $mMembersRepository
        )
    {
        $this->mMembersRepository = $mMembersRepository;
    }

    public function login($condition)
    {
        $user = $this->mMembersRepository->getUserLoginInfo($condition->email);
        if (isset($user)) {
            if (password_verify($condition['password'], $user->password)) {
                $convertedUser = json_decode(json_encode($user), true);
                $this->addUserSession($condition, $convertedUser);
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ok'),
                    'message' => '',
                    'accessTime' => getAccessTime(),
                    'ret' => true,
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
    private function addUserSession($request, $user)
    {
        $request->session()->put('user', $user);
        return true;
    }

    /**
     * ユーザーを簡易新規登録する
     * @param  Object $condition Request
     * @return Array            結果コードを含む配列
     */
    public function easyRegist($condition)
    {
        try {
            $user = $this->mMembersRepository->getUserLoginInfo($condition->email);
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
                $result = $this->mMembersRepository->save(['member_id' => 'new'], $info);
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ok'),
                    'message' => app('MessageCreater')->getLoginMessage('regist_success'),
                ];
            } else {
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ng'),
                    'message' => app('MessageCreater')->getLoginMessage('already_exists'),
                ];
            }
        } catch (\Exception $e) {
            $ret = [
                'code' => app('CodeCreater')->getResponseCode('ng'),
                'message' => app('MessageCreater')->getCommonErrorMessage(),
            ];
        }
        $ret['accessTime'] = getAccessTime();
        return $ret;
    }
}
