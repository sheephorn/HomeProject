<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class m_places extends Model
{
    protected $table = 'm_places';
    protected $primaryKey = 'place_id';
    public $timestamps = false;
    protected $guarded = ['place_id'];
}
