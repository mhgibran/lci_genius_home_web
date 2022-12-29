<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDenda extends Model
{
    protected $table = 'billing_denda';
    protected $primaryKey = 'id_unit_owner';
    public $timestamps = false;
}
