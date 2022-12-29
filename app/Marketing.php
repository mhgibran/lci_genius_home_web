<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    protected $table = 'mst_marketing';
    protected $primaryKey = 'id_marketing';
    public $timestamps = false;
}
