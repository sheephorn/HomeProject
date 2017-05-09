<?php

namespace  App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class t_document_places extends Model
{
    protected $table = 't_document_places';
    protected $primaryKey = 'place_id';
    protected $guarded = ['folder_id'];
    public $timestamps = true;
}
