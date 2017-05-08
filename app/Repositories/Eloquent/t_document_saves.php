<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class t_document_saves extends Model
{
    protected $table = 't_document_saves';
    protected $primaryKey = 'document_id';
    public $timestamps = true;
    protected $guarded = ['document_id'];
}
