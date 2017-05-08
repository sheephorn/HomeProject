<?php

namespace App\Repositories;

use App\Repositories\Eloquent\t_document_tags;

class TDocumentTagsRepository extends BaseRepository
{
    protected $model;

    public function __construct(t_document_tags $t_document_tags)
    {
        $this->model = $t_document_tags;
    }

}
