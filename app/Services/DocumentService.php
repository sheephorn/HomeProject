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
        // $data['data'] =
        $data['code'] = app('CodeCreater')->getResponseCode('ok');
        $data['message'] = '';
        $data['accessTime'] = getAccessTime();
        return $data;
    }
}
