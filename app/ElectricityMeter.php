<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectricityMeter extends Model
{
    protected $table = 'listrik_meter';
    protected $primaryKey = 'id_unit_apart';
    protected $fillable = array('listrik_awal', 'listrik_akhir');
    public $timestamps = false;
}
