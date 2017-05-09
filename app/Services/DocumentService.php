<?php

namespace App\Services;

use App\Repositories\TDocumentPlacesRepository;
use App\Repositories\TDocumentSavesRepository;
use App\Repositories\TDocumentTagsRepository;
use App\Repositories\THhomebudgetConnectsRepository;
use Illuminate\Http\Request;

class DocumentService extends BaseService
{
    protected $tDocumentPlacesRepository;
    protected $tDocumentSavesRepository;
    protected $tDocumentTagsRepository;
    protected $tHhomebudgetConnectsRepository;

    public function __construct(
        TDocumentPlacesRepository $tDocumentPlacesRepository,
        TDocumentSavesRepository $tDocumentSavesRepository,
        TDocumentTagsRepository $tDocumentTagsRepository,
        THhomebudgetConnectsRepository $tHhomebudgetConnectsRepository
        )
    {
        $this->tDocumentPlacesRepository = $tDocumentPlacesRepository;
        $this->tDocumentSavesRepository = $tDocumentSavesRepository;
        $this->tDocumentTagsRepository = $tDocumentTagsRepository;
        $this->tHhomebudgetConnectsRepository = $tHhomebudgetConnectsRepository;
    }

    /**
     * 書類一覧のページ取得
     * @param  Object $condition Request
     * @return Array            結果コードを含む配列
     */
    public function getList($condition)
    {
        $data['select'] = [
            'homebudget' => $this->tHhomebudgetConnectsRepository->getHomebudgetList(getUserSession($condition)['member_id']),
            'important' => ['1' => '高', '2' => '中', '3' => '低'],
            'folders' => $this->tDocumentPlacesRepository->getDocumentPlaceList(getUserSession($condition)['member_id']),
        ];
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
        $condition['memberId'] = getUserSession($condition)['member_id'];
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
                    $resultPlace = $this->addPlace($condition, $resultDocument);
                    $resultTag = $this->addTag($condition, $resultDocument);
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

    /**
     * Documentの新規作成
     * @param Object $condition Request
     * @return Object 作成レコード
     */
    private function addDocument($condition)
    {
        $documentId = $this->getNewDocumentId(intval($condition['homebudgetId']));
        $attr = ['document_id' => $documentId];
        $contents = [
            'document_id' => $documentId,
            'homebudget_id' => $condition['homebudgetId'],
            'title' => $condition['title'],
            'important' => $condition['important'],
            'description' => $condition['description'],
            'save_limit' => getStandardDateFormat($condition['limitDate']),
        ];
        $ret = $this->tDocumentSavesRepository->save($attr, $contents);
        return $ret;
    }

    /**
     * 保管場所の新規作成
     * @param Object $condition Request
     * @param Object $document  Documentの新規作成レコード
     */
    private function addPlace($condition, $document)
    {
        $attr = [
            'folder_id' => $condition['folderId'],
            'address' => $condition['address'],
        ];
        $contents = [
            'folder_id' => ($condition['folderId'] !== '') ? $condition['folderId'] : $this->getNewFolderId(),
            'folder_name' => $condition['folderName'],
            'address' => $condition['address'],
            'document_id' => $document->document_id,
        ];
        $ret = $this->tDocumentPlacesRepository->save($attr, $contents);
        return $ret;
    }

    /**
     * タグの新規作成
     * @param Object $condition Request
     * @param Object $document  Documentの新規作成レコード
     */
    private function addTag($condition, $document)
    {
        $ret = [];
        $separator = ' '; // 半角空白で区切る
        $replaceTargets = [
            '　', // 全角空白
        ];
        $tags = implode($separator, preg_replace($replaceTargets, $separator, $condition['tags']));
        foreach ($tags as $tag) {
            $contents = [
                'document_id' => $document->document_id,
                'tag_name' => '',
            ];
            $ret[] = $this->tDocumentTagsRepository->save($contents, $contents);
        }
        return $ret;
    }

    /**
     * 書類を新規登録の際のidを返す
     * @param  Int $homebudgetId 家計id
     * @return Int               書類id
     */
    private function getNewDocumentId($homebudgetId)
    {
        $ret = $this->tDocumentSavesRepository->getCurrentMaxDocumentId($homebudgetId);
        if(isset($ret) && is_int($ret)) {
            $num = ++$ret;
        } else {
            $num = str_replace('/[^0-9]/', '', getCurrentDate()). sprintf('%03', 1);
        }
        return intval($num);
    }

    /**
     * 新規のフォルダーidを返す
     * @return Int 新規のフォルダーid
     */
    private function getNewFolderId()
    {
        $num = $this->tDocumentPlacesRepository->getCurrentMaxFolderId();
        return ++$num;
    }
}
