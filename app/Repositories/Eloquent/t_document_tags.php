<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class t_document_tags extends Model
{
    protected $table = 't_document_tags';
    protected $primaryKey = 'tag_id';
    protected $guarded = ['tag_id'];
    public $timestamps = false;
}
