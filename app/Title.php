<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'mst_title';
    protected $primaryKey = 'id_title';
    public $timestamps = false;


    
}
