<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillAgingView extends Model
{
    protected $table = 'v_billing_aging';
    protected $primaryKey = 'id_unit_owner';
    public $timestamps = false;
}
