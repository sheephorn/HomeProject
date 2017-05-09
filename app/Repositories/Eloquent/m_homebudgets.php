<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class m_homebudgets extends Model
{
    protected $table = 'm_homebudgets';
    protected $primaryKey = 'homebudget_id';
    public $timestamps = true;
    protected $guarded = ['homebudget_id'];
}
