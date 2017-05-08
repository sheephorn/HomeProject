<?php

namespace App\Repositories;

use App\Repositories\Eloquent\t_document_saves;

class TDocumentSavesRepository extends BaseRepository
{
    protected $model;

    public function __construct(t_document_saves $t_document_saves)
    {
        $this->model = $t_document_saves;
    }

    public function createQuery($condition)
    {
        $query = $this->getFromQuery($condition);
        $query = $this->getSelectQuery($condition, $query);
        $query = $this->getWhereQuery($condition, $query);
        $query = $this->orderByQuery($condition, $query);
        return $query;
    }

    protected function getFromQuery($condition)
    {
        $query = \DB::table('t_document_saves as documents')
        ->leftjoin('t_document_places as places', 'documents.document_id', '=', 'places.document_id')
        ->leftjoin('t_document_tags as tags', 'documents.document_id', '=', 'tags.document_id')
        ->leftjoin('t_homebudget_connects as connects', 'documents.homebudget_id', '=', 'connects.homebudget_id')
        ->leftjoin('m_members as members', 'connects.member_id', '=', 'members.member_id')
        ->groupBy('documents.document_id')
        ;
        return $query;
    }

    protected function getSelectQuery($condition, $query)
    {
        $selectArray = [
            'documents.document_id',
            'documents.title',
            'documents.important',
            'documents.save_limit',
            \DB::raw('GROUP_CONCAT(tags.tag_name) as tags '),
            'places.folder_id',
            'places.folder_name',
            'places.address',
        ];
        $query = $query->select($selectArray)->distinct();
        return $query;
    }

    protected function getWhereQuery($condition, $query)
    {
        $query = $query
            ->where(function($tempQuery) use ($condition){
                $target = 'tag';
                if (isset($condition[$target]) && $condition[$target] !== '') {
                    $tags = implode(' ', $condition[$target]);
                    $tempQuery->whereIn('base.tag_name', $tags);
                }
            })
            ->where(function($tempQuery) use ($condition){
                $target = 'memberId';
                if (isset($condition[$target]) && $condition[$target] !== '') {
                    $tempQuery->where('members.member_id', $condition[$target]);
                }
            })
            ->where(function($tempQuery) use ($condition){
                $target = 'homebudgetId';
                if (isset($condition[$target]) && $condition[$target] !== '') {
                    $tempQuery->where('documents.homebudget_id', $condition[$target]);
                }
            })
            ;
        return $query;
    }

    protected function orderByQuery($condition, $query)
    {
        $sortArray = [
            'documentId' => 'documents.document_id'
        ];
        $query = $this->orderBy($query, $condition, $sortArray);
        return $query;
    }

}
