<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class t_homebudget_connects extends Model
{
    protected $table = 't_homebudget_connects';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
}
