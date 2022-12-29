<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTenant extends Model
{
    protected $table = 'mst_menu_unit_tenant';
    protected $primaryKey = 'id_menu_unit_tenant';
    public $timestamps = false;
}
