<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'mst_gender';
    protected $primaryKey = 'id_gender';
    public $timestamps = false;
}
