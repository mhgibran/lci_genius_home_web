<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxMethod extends Model
{
    protected $table = 'mst_tax_method';
    protected $primaryKey = 'id_tax_method';
    public $timestamps = false;
}
