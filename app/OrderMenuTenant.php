<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMenuTenant extends Model
{
    protected $table = 'mst_order_menu_tenant';
    protected $primaryKey = 'id_order_menu_tenant';
    public $timestamps = false;
}
