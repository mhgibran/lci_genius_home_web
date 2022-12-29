<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillOwner extends Model
{
    protected $table = 'billing_owner';
    protected $primaryKey = 'id_billing_owner';
    public $timestamps = false;
}
