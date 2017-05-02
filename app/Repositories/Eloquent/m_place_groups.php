<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class m_place_groups extends Model
{
    protected $table = 'm_place_groups';
    protected $primaryKey = 'group_id';
    public $timestamps = false;
    protected $guarded = ['group_id'];
}
