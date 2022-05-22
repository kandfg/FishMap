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
        return response()->json(['fishCoordinates' => $fishCoordinates]);
    }
}
