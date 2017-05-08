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

}
