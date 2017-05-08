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

    /**
     * 書類一覧のページ取得
     * @param  Object $condition Request
     * @return Array            結果コードを含む配列
     */
    public function getList($condition)
    {

        $data['code'] = app('CodeCreater')->getResponseCode('ok');
        $data['message'] = '';
        $data['accessTime'] = getAccessTime();
        return $data;
    }

    /**
     * 書類一覧のコンテンツ取得
     * @param  Object $condition Request
     * @return Array            結果コードを含む配列
     */
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

    public function add($condition)
    {
        $can = $this->canAdd($condition);
        if($can['ret']) {
            try {
                $ret = \DB::transaction(function() use ($condition){
                    $resultDocument = $this->addDocument($condition);
                    $resultPlace = $this->addPlace($condition);
                    $resultTag = $this->addTag($condition);
                    return [
                        'code' => app('CodeCreater')->getResponseCode('ok'),
                        'message' => app('MessageCreater')->getAddHomebudgetMessage('success'),
                    ];
                });
            } catch (\Exception $e) {
                createErrorLog($e, $condition);
                $ret = [
                    'code' => app('CodeCreater')->getResponseCode('ng'),
                    'message' => app('MessageCreater')->getCommonErrorMessage(),
                ];
            }
        } else {
            $ret = [
                'code' => app('CodeCreater')->getResponseCode('ng'),
                'message' => $can['message'],
            ];
        }
        $ret['accessTime'] = getAccessTime();
        return $ret;
    }

    /**
     * 書類の追加が可能か判断
     * @param  Object $condition Request
     * @return Array            判断結果・メッセージを含む配列
     */
    private function canAdd($condition)
    {
        $searchArray = [
            'folderName' => $condition['folderName'],
            'address' => $condition['address'],
            'homebudgetId' => $condition['homebudgetId'],
        ];
        $data = $this->tDocumentSavesRepository->createQuery($searchArray)->first();
        $can['ret'] = true;
        // 家計に同一フォルダがある場合
        if($condition['folderId'] === '' && isset($data)) {
            $can['message'] = '';
            $can['ret'] =false;
        }
        // 指定のアドレスがすでに使われている場合ＮＧ
        if(isset($data)) {
            $can['message'] = '';
            $can['ret'] =false;
        }
        return $can;
    }

    private function addDocument($condition)
    {
        $documentId = $this->getDocumentId(intval($condition['homebudgetId']));
        $attr = ['document_id' => $condition['documentId']];
        $contents = [
            'document_id' => $documentId,
            'homebudget_id' => $condition['homebudgetId'],
            'title' => $condition['title'],
            'important' => $condition['important'],
            'description' => $condition['description'],
            'save_limit' => $condition['limitDate'],
        ];

        $ret = $this->tDocumentSavesRepository->save($attr, $contents);
    }

    private function addPlace($condition)
    {

    }

    private function addTag($condition)
    {

    }

    /**
     * 書類を新規登録の際のidを返す
     * @param  Int $homebudgetId 家計id
     * @return Int               書類id
     */
    private function getDocumentId($homebudgetId)
    {
        $ret = $this->tDocumentSavesRepository->getCurrentMaxDocumentId($homebudgetId);
        if(isset($ret) && is_int($ret)) {
            $num = ++$ret;
        } else {
            $num = str_replace('/[^0-9]/', '', getCurrentDate()). sprintf('%03', 1);
        }
        return intval($num);
    }
}
