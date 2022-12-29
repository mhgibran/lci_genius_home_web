<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplainCategory extends Model
{
    protected $table = 'mst_complain_category';
    protected $primaryKey = 'id_complain_category';
    public $timestamps = false;
    
}