<?php

namespace App\Repositories;

use App\Repositories\Eloquent\t_homebudget_connects;

class THhomebudgetConnectsRepository extends BaseRepository
{
    protected $model;

    public function __construct(t_homebudget_connects $t_homebudget_connects)
    {
        $this->model = $t_homebudget_connects;
    }

}
