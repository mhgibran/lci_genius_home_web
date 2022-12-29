<?php

namespace App\Imports;

use App\WaterMeter;
use App\WaterMeterHistory;
use App\UnitApart;
use App\UnitOwner;
use App\V_Helper_Unit;
use App\Floor;
use App\Tower;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use DateTime;

class WaterMeterImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $flag = false;
    public function model(array $row)
    {
        $data = V_Helper_Unit::select("id_unit_apart")
            ->where('namaApart','=',$row[0])
            ->first();
            
        if(!empty($data)){
            $final = WaterMeter::find($data->id_unit_apart);

            $history = new WaterMeterHistory;

            $tgl = new DateTime();
            $tgl_air = date("m-Y", $tgl->getTimestamp());
            $pecah_tgl = explode("-",$tgl_air);
            $bulan = $pecah_tgl[0];
            $tahun = $pecah_tgl[1];

            if(count((array)$final)>0 && $final->air_awal == 0){
                $final->air_awal = $row[1];
                $final->air_akhir = $row[2];
                $final->pemakaian_air = $row[2] - $row[1];

                $history->id_unit_apart = $final->id_unit_apart;
                $history->air_awal = $row[1];
                $history->air_akhir = $row[2];
                $history->pemakaian_air = $row[2] - $row[1];
                $history->bulan = $bulan;
                $history->tahun = $tahun;
                $history->save();
                return $final;
            }
            elseif(count((array)$final)>0 && $final->air_awal != 0){
                $final->air_awal = $final->air_akhir;
                $final->air_akhir = $row[2];
                $final->pemakaian_air = $row[2] - $final->air_awal;

                $history->id_unit_apart = $final->id_unit_apart;
                $history->air_awal = $final->air_awal;
                $history->air_akhir = $row[2];
                $history->pemakaian_air = $row[2] - $history->air_awal;
                $history->bulan = $bulan;
                $history->tahun = $tahun;
                $history->save();
                return $final;
            }
            else{
                return null;
            }
        }
    }
}
