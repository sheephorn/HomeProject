<?php

namespace App\Repositories;

use App\Repositories\Eloquent\t_document_places;

class TDocumentPlacesRepository extends BaseRepository
{
    protected $model;

    public function __construct(t_document_places $t_document_places)
    {
        $this->model = $t_document_places;
    }

    /**
     * 既存レコードのfolder_idの最大値を返す
     * @return Int 最大値
     */
    public function getCurrentMaxFolderId()
    {
        return $this->model->max('folder_id');
    }

    public function getDocumentPlaceList($memberId)
    {
        $ret = \DB::table('t_document_saves as documents')
        ->leftjoin('t_homebudget_connects as conects', 'documents.homebudget_id', '=', 'conects.homebudget_id')
        ->leftjoin('t_document_places as places', 'documents.document_id', '=', 'places.document_id')
        ->select(
            'conects.homebudget_id',
            'places.folder_name',
            'places.folder_id'
            )
        ->where('conects.member_id', $memberId)
        ->distinct()
        ->get()
        ;
        \Log::debug($ret);
        return $ret;
    }

}
