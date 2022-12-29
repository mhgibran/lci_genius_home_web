<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConciergeCategory extends Model
{
    protected $table = 'mst_concierge_category';
    protected $primaryKey = 'id_concierge_category';
    public $timestamps = false;
    
}