<?php

namespace App\Services;

use App\Repositories\TDocumentPlacesRepository;
use App\Repositories\TDocumentSavesRepository;
use App\Repositories\TDocumentTagsRepository;

class DocumentService extends BaseService
{
    protected $tDocumentPlacesRepository;
    protected $tDocumentSavesRepository;
    protected $tDocumentTagsRepository;

    public function __construct(
        TDocumentPlacesRepository $tDocumentPlacesRepository,
        TDocumentSavesRepository $tDocumentSavesRepository,
        TDocumentTagsRepository $tDocumentTagsRepository
        )
    {
        $this->tDocumentPlacesRepository = $tDocumentPlacesRepository;
        $this->tDocumentSavesRepository = $tDocumentSavesRepository;
        $this->tDocumentTagsRepository = $tDocumentTagsRepository;
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
        $condition = $this->pageInit($condition);
        $data['data'] = $this->tDocumentSavesRepository->createQuery($condition)->get();
        $data['code'] = app('CodeCreater')->getResponseCode('ok');
        $data['message'] = '';
        $data['accessTime'] = getAccessTime();
        return $data;
    }

    /**
     * ページの初期設定
     * @param  Object $condition Request
     * @return    Object         Request
     */
    private function pageInit($condition)
    {
        $condition['memberId'] = $condition->session()->get('member_id');
        $condition['show'] = isset($condition['show']) ? $condition['show'] : config('const.showListRecordsNumber');
        $condition['page'] = isset($condition['page']) ? $condition['page'] : config('const.startPage');
        /**
         * デフォルトのソート・並び順の定義
         */
        $defaultSort = 'documentId';
        $defaultOrder = 'desc';
        $condition['sort'] = isset($condition['sort']) ? $condition['sort'] : $defaultSort;
        $condition['order'] = isset($condition['order']) ? $condition['order'] : $defaultOrder;

        return $condition;
    }
}
