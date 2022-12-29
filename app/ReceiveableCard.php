<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveableCard extends Model
{
    protected $table = 'mst_unit_owner';
    protected $primaryKey = 'id_unit_owner';
    public $timestamps = false;
}
