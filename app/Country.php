<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'mst_country';
    protected $primaryKey = 'id_country';
    public $timestamps = false;
}
