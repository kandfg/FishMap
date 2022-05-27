<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FishCoordinate;
class MapController extends Controller
{
    public function index(){
        $map=FishCoordinate::all();
        return view('map');
    }
    public function getCoordinate(){
        $fishCoordinates=FishCoordinate::all();
        foreach($fishCoordinates as $fishCoordinate){
            $fishCoordinate->fishs;
        }
        return response()->json(['fishCoordinates' => $fishCoordinates]);
    }
}
