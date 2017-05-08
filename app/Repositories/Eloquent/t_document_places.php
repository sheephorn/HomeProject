<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class t_document_places extends Model
{
    protected $table = 't_document_places';
    protected $primaryKey = ['folder_id', 'address'];
    public $timestamps = true;
    protected $guarded = ['folder_id', 'address'];
}
