<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class m_homebudgets extends Model
{
    protected $table = 'm_homebudgets';
    protected $primaryKey = 'homebudgets_id';
    public $timestamps = true;
    protected $guarded = ['homebudgets_id'];
}
