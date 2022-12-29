<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillAging extends Model
{
    protected $table = 'billing_owner';
    protected $primaryKey = 'id_billing_owner';
    public $timestamps = false;
}
