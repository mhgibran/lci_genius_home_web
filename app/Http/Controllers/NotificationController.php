<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concierge;
use App\Complain;

class NotificationController extends Controller
{
    public function getNewConcierge(){
    	$data = Concierge::where('id_concierge_status','=',1);
    	return response()->json(array('new_concierge' => $data->count()), 200);
    }

    public function getNewComplain(){
    	$data = Complain::where('id_complain_status','=',1);
    	return response()->json(array('new_complain' => $data->count()), 200);
    }
    
}
