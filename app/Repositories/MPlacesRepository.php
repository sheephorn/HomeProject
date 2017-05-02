<?php

namespace App\Repositories;

use App\Repositories\Eloquent\m_places;

class MPlacesRepository extends BaseRepository
{
    protected $model;

    public function __construct(m_places $m_places)
    {
        $this->model = $m_places;
    }
}
