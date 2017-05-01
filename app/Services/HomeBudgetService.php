<?php

namespace App\Services;

use App\Repositories\MMembersRepository;
use App\Repositories\MHomebudgetsRepository;
use App\Repositories\THhomebudgetConnectsRepository;

class HomeBudgetService extends BaseService
{
    protected $mMembersRepository;
    protected $mHomebudgetsRepository;
    protected $tHhomebudgetConnectsRepository;

    public function __construct(
        MMembersRepository $mMembersRepository,
        MHomebudgetsRepository $mHomebudgetsRepository,
        THhomebudgetConnectsRepository $tHhomebudgetConnectsRepository
        )
    {
        $this->mMembersRepository = $mMembersRepository;
        $this->mHomebudgetsRepository = $mHomebudgetsRepository;
        $this->tHhomebudgetConnectsRepository = $tHhomebudgetConnectsRepository;
    }

    public function getEditPage($condition)
    {
        // $data = $this->sasasa->sasasa();
        $data['code'] = app('CodeCreater')->getResponseCode('ok');
        $data['message'] = '';
        $data['accessTime'] = getAccessTime();
        return $data;
    }

    public function add($condition)
    {
        $conditions = [
            'managerId' => $condition->session()->get('user')['member_id'],
            'homebudgetName' => $condition->name,
        ];
        $homebudget = $this->mHomebudgetsRepository->createQuery($conditions)->first();
        if( !isset($homebudget) ) {
            // ok
            try {
                $ret = \DB::transaction(function() use ($condition){
                    $homebudgetContents = [
                        'name' => $condition->name,
                        'manager_id' => $condition->session()->get('user')['member_id'],
                    ];
                    $homebudget = $this->mHomebudgetsRepository->save(['homebudget_id' => 0], $homebudgetContents);
                    $connectionContents = [
                        'member_id' => $condition->session()->get('user')['member_id'],
                        'homebudget_id' => $homebudget->homebudget_id,
                    ];
                    $connection = $this->tHhomebudgetConnectsRepository->save(['id' => 0], $connectionContents);

                    $ret = [
                        'code' => app('CodeCreater')->getResponseCode('ok'),
                        'message' => app('MessageCreater')->getAddHomebudgetMessage('success'),
                        'accessTime' => getAccessTime(),
                    ];
                    return $ret;
                });
            } catch(\Exception $e) {
                // 例外処理
                createErrorLog($e, $condition);
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ng'),
                    'message' => app('MessageCreater')->getCommonErrorMessage(),
                    'accessTime' => getAccessTime(),
                ];
            }
        } else {
            // ng すでに同名の家計を管理している場合
            $ret = [
                'code' => app('CodeCreater')->getResponseCode('ng'),
                'message' => app('MessageCreater')->getAddHomebudgetMessage('already_exists'),
                'accessTime' => getAccessTime(),
            ];
        }
        return $ret;
    }

}
