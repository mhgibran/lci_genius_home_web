<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitTenant extends Model
{
    protected $table = 'mst_unit_tenant';
    protected $primaryKey = 'id_unit_tenant';
    public $timestamps = false;
}
