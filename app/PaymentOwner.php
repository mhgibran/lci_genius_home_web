<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentOwner extends Model
{
    protected $table = 'payment_owner';
    protected $primaryKey = 'id_payment_owner';
    public $timestamps = false;
}
