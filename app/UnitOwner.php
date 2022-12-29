<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitOwner extends Model
{
    protected $table = 'mst_unit_owner';
    protected $primaryKey = 'id_unit_owner';
    protected $fillable = array('login', 'nama_depan', 'nama_belakang', 'tgl_lahir', 'id_gender', 'no_ktp', 'no_npwp', 'no_passport', 'alamat_surat', 'alamat_ktp', 'no_telp', 'no_hp', 'no_bast', 'emergency_name', 'emergency_no', 'email');
    public $timestamps = false;
}
