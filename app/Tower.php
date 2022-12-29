<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    protected $table = 'mst_tower';
    protected $primaryKey = 'id_tower';
    public $timestamps = false;
}
