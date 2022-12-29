<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillLebihBayar extends Model
{
    protected $table = 'billing_lebih_bayar';
    protected $primaryKey = 'id_unit_owner';
    public $timestamps = false;
}
