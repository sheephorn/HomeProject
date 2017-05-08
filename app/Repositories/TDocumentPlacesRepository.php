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

}
