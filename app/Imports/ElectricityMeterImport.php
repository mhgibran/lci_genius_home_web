<?php

namespace App\Imports;

use App\ElectricityMeter;
use App\ElectricityMeterHistory;
use App\UnitApart;
use App\UnitOwner;
use App\V_Helper_Unit;
use App\Floor;
use App\Tower;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use DateTime;

// class ElectricityMeterImport implements ToModel
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */

//     public $flag = false;
//     public function model(array $row)
//     {
//         $temp = str_replace(" kWh","",$row[1]);

//         $data = V_Helper_Unit::select("id_unit_apart")
//             ->where('namaApart','=',$temp)
//             ->first();
            
//         if(!empty($data)){
//             $final = ElectricityMeter::find($data->id_unit_apart);

//             $history = new ElectricityMeterHistory;

//             $tgl = new DateTime();
//             $tgl_listrik = date("m-Y", $tgl->getTimestamp());
//             $pecah_tgl = explode("-",$tgl_listrik);
//             $bulan = $pecah_tgl[0];
//             $tahun = $pecah_tgl[1];

//             if(count((array)$final)>0 && $final->listrik_awal == 0){
//                 $final->listrik_awal = $row[3];
//                 $final->listrik_akhir = $row[4];
//                 $final->pemakaian_listrik = $row[4] - $row[3];
                
//                 $history->id_unit_apart = $final->id_unit_apart;
//                 $history->listrik_awal = $row[3];
//                 $history->listrik_akhir = $row[4];
//                 $history->pemakaian_listrik = $row[4] - $row[3];
//                 $history->bulan = $bulan;
//                 $history->tahun = $tahun;
//                 $history->save();
//                 return $final;
//             }
//             elseif(count((array)$final)>0 && $final->listrik_awal != 0){
//                 $final->listrik_awal = $final->listrik_akhir;
//                 $final->listrik_akhir = $row[4];
//                 $final->pemakaian_listrik = $row[4] - $final->listrik_awal;
                
//                 $history->id_unit_apart = $final->id_unit_apart;
//                 $history->listrik_awal = $final->listrik_awal;
//                 $history->listrik_akhir = $row[4];
//                 $history->pemakaian_listrik = $row[4] - $history->listrik_awal;
//                 $history->bulan = $bulan;
//                 $history->tahun = $tahun;
//                 $history->save();
//                 return $final;
//             }
//             else{
//                 return null;
//             }
//         }
//     }

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
        // $temp = str_replace(" kWh","",$row[1]);

        $data = V_Helper_Unit::select("id_unit_apart")
            ->where('namaApart','=',$row[0])
            ->first();
            
        if(!empty($data)){
            $final = ElectricityMeter::find($data->id_unit_apart);
            $history = new ElectricityMeterHistory;

            $tgl = new DateTime();
            $tgl_listrik = date("m-Y", $tgl->getTimestamp());
            $pecah_tgl = explode("-",$tgl_listrik);
            $bulan = $pecah_tgl[0];
            $tahun = $pecah_tgl[1];
            if(count((array)$final)>0 && $final->listrik_awal == 0){
                $final->listrik_awal = $row[1];
                $final->listrik_akhir = $row[2];
                $final->pemakaian_listrik = $row[2] - $row[1];

                $history->id_unit_apart = $final->id_unit_apart;
                $history->listrik_awal = $row[1];
                $history->listrik_akhir = $row[2];
                $history->pemakaian_listrik = $row[2] - $row[1];
                $history->bulan = $bulan;
                $history->tahun = $tahun;
                $history->save();
                return $final;
            }
            elseif(count((array)$final)>0 && $final->listrik_awal != 0){
                $final->listrik_akhir =  $final->listrik_akhir;
                $final->pemakaian_listrik = $row[2] - $final->listrik_awal;

                $history->id_unit_apart = $final->id_unit_apart;
                $history->listrik_awal = $final->listrik_awal;
                $history->listrik_akhir = $row[2];
                $history->pemakaian_listrik = $row[2] - $row[1];
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
