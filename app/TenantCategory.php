<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantCategory extends Model
{
    protected $table = 'mst_tenant_category';
    protected $primaryKey = 'id_tenant_category';
    public $timestamps = false;
    
}