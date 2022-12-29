<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $table = 'mst_menu_category';
    protected $primaryKey = 'id_menu_category';
    public $timestamps = false;
}
