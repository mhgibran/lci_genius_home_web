<?php

namespace App\Imports;

use App\UnitOwner;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UnitOwnerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $row[6]);
        return new UnitOwner([
            'id_unit_apart'     => $row[1],
            'login'    => $row[2].'-owner', 
            'id_title'     => $row[3],
            'nama_depan' => $row[4],
            'nama_belakang'    => $row[5],
            'tgl_lahir'    => $date,
            'id_gender'    => $row[7],
            'no_ktp'    => $row[8],
            'no_npwp'    => $row[9],
            'no_passport'    => $row[10],
            'id_country'    => $row[11],
            'alamat_ktp'    => $row[12],
            'alamat_surat'    => $row[13],
            'no_telp'    => $row[14],
            'no_hp'    => $row[15],
            'jml_penghuni'    => $row[16],
            'no_bast'    => $row[17],
            'emergency_name'    => $row[18],
            'emergency_no'    => $row[19],
            'email'    => $row[20]
        ]);

        return new User([
            'login'     => $row[2].'-owner',
            'username'    => $row[2].'-owner', 
            'password' => Hash::make('password'),
            'name'    => $row[4],
            'email'    => $row[20],
            'priv_status'    => 10,
            'status'    => 1,
            'created_at' => now()
        ]);
    }
}
