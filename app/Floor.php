<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table = 'mst_floor';
    protected $primaryKey = 'id_floor';
    public $timestamps = false;
}
