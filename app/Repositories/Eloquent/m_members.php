<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class m_members extends Model
{
    protected $table = 'm_members';
    protected $primaryKey = 'member_id';
    public $timestamps = true;
    protected $guarded = ['member_id'];
}
