<?php

namespace App\Repositories;

use App\Repositories\Eloquent\m_place_groups;

class MPlaceGroupsRepository extends BaseRepository
{
    protected $model;

    public function __construct(m_place_groups $m_place_groups)
    {
        $this->model = $m_place_groups;
    }

    public function getGroupList()
    {
        return $this->model->lists('group_name', 'group_id');
    }

    public function findByName($name)
    {
        return $this->model->where('group_name', $name)->first();
    }
}
