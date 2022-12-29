<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectricityMeterHistory extends Model
{
    protected $table = 'listrik_meter_history';
    protected $primaryKey = 'id_unit_apart';
    protected $fillable = array('listrik_awal', 'listrik_akhir');
    public $timestamps = false;
}
