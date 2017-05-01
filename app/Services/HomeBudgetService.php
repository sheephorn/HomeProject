<?php

namespace App\Services;

use App\Repositories\MMemberRepository;

class HomeBudgetService extends BaseService
{
    protected $mMemberRepository;

    public function __construct(
        MMemberRepository $mMemberRepository
        )
    {
        $this->mMemberRepository = $mMemberRepository;
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

    }

}
