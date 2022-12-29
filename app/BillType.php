<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    protected $table = 'mst_bill_type';
    protected $primaryKey = 'id_bill_type';
    public $timestamps = false;
}
