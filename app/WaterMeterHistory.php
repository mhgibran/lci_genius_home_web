<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaterMeterHistory extends Model
{
    protected $table = 'air_meter_history';
    protected $primaryKey = 'id_unit_apart';
    protected $fillable = array('air_awal', 'air_akhir');
    public $timestamps = false;
}
