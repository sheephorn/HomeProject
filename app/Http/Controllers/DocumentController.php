<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentService;

class DocumentController extends BaseController
{
    protected $documentService;

    public function __construct(
        DocumentService $documentService
        )
    {
        $this->documentService = $documentService;
    }

    /**
     * 書類一覧ページの表示
     * @param  Object $request Request
     * @return HTML           画面
     */
    public function getList(Request $request)
    {
        $data = $this->documentService->getList($request);
        return view('page.documentList', compact('data', 'request'));
    }

    /**
     * 書類一覧データの取得
     * @param  Object $request Request
     * @return Array           リストデータを含む配列
     */
    public function getListContents(Request $request)
    {
        $data = $this->documentService->getListContents($request);
        return $data;
    }

    public function add(Request $request)
    {
        $data = $this->documentService->add($request);
        return $data;
    }

    public function edit(Request $request)
    {
        $data = $this->documentService->edit($request);
        return $data;
    }

    public function delete(Request $request)
    {
        $data = $this->documentService->delete($request);
        return $data;
    }

}
