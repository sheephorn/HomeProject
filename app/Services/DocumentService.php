<?php

namespace App\Services;

use App\Repositories\MMembersRepository;
use App\Repositories\MHomebudgetsRepository;
use App\Repositories\THhomebudgetConnectsRepository;

class DocumentService extends BaseService
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

    public function getList($condition)
    {
        $data['code'] = app('CodeCreater')->getResponseCode('ok');
        $data['message'] = '';
        $data['accessTime'] = getAccessTime();
        return $data;
    }

    public function getListContents($condition)
    {
        // $data['data'] = 
        $data['code'] = app('CodeCreater')->getResponseCode('ok');
        $data['message'] = '';
        $data['accessTime'] = getAccessTime();
        return $data;
    }
}
