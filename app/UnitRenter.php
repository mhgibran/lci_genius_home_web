<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitRenter extends Model
{
    protected $table = 'mst_unit_renter';
    protected $primaryKey = 'id_unit_renter';
    public $timestamps = false;
}
