<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FishClass;
class WebController extends Controller
{
    public function getFish(){
        $fishclasses=FishClass::all();
        foreach($fishclasses as $fishclass){
            $fishclass->fishs;
        }
        return response()->json(['class' => $fishclasses]);
    }
    public function contact_us()
    {
        return view('contact_us');
    }
}
