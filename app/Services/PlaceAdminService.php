<?php

namespace App\Services;

use App\Repositories\MPlaceGroupsRepository;
use App\Repositories\MPlacesRepository;

class PlaceAdminService extends BaseService
{
    protected $mPlaceGroupsRepository;
    protected $mPlacesRepository;

    public function __construct(
        MPlaceGroupsRepository $mPlaceGroupsRepository,
        MPlacesRepository $mPlacesRepository
        )
    {
        $this->mPlaceGroupsRepository = $mPlaceGroupsRepository;
        $this->mPlacesRepository = $mPlacesRepository;
    }

    public function getPage($condition)
    {
        $data['select']['groups'] = $this->mPlaceGroupsRepository->getGroupList();
        $data['code'] = app('CodeCreater')->getResponseCode('ok');
        $data['message'] = '';
        $data['accessTime'] = getAccessTime();
        return $data;
    }

    public function addPlace($condition)
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

    public function addGroup($condition)
    {
        $group = $this->mPlaceGroupsRepository->findByName($condition->groupName);
        if(!isset($group)){
            try {
                $ret = \DB::transaction(function() use ($condition){
                    $result = $this->mPlaceGroupsRepository->save(['group_id' => 0], ['group_name' => $condition->groupName]);
                    return [
                        'code' => app('CodeCreater')->getResponseCode('ok'),
                        'message' => app('MessageCreater')->getAddPlaceGroupsMessage('success'),
                    ];
                });
            } catch(\Exception $e) {
                createErrorLog($e, $condition);
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ng'),
                    'message' => app('MessageCreater')->getCommonErrorMessage(),
                ];
            }
        } else {
            $ret = [
                'code' => app('CodeCreater')->getResponseCode('ng'),
                'message' => app('MessageCreater')->getAddPlaceGroupsMessage('already_exists'),
            ];
        }
        $ret['accessTime'] = getAccessTime();
        return $ret;
    }

}
