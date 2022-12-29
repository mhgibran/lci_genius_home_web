<?php

namespace App\Imports;

use App\ElectricityMeter;
use App\UnitApart;
use App\UnitOwner;
use App\V_Helper_Unit;
use App\Floor;
use App\Tower;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;

class ElectricityMeterImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $flag = false;
    public function model(array $row)
    {
        $temp = str_replace(" kWh","",$row[1]);

        $data = V_Helper_Unit::select("id_unit_apart")
            ->where('namaApart','=',$temp)
            ->first();
            
        if(!empty($data)){
            $final = ElectricityMeter::find($data->id_unit_apart);
            if(count((array)$final)>0 && $final->listrik_awal == 0){
                $final->listrik_awal = $row[3];
                $final->listrik_akhir = $row[4];
                $final->pemakaian_listrik = $row[4] - $row[3];
                return $final;
            }
            elseif(count((array)$final)>0 && $final->listrik_awal != 0){
                $final->listrik_akhir = $row[4];
                $final->pemakaian_listrik = $row[4] - $final->listrik_awal;
                return $final;
            }
            else{
                return null;
            }
        }
    }
}

