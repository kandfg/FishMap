<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Fish;
use App\Models\FishCoordinate;
use App\Http\Controllers\Controller;
use App\Models\FishClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CoordinateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user()->id;
        $fishClasses=FishClass::all();
        $fishs=Fish::select('id','name')->get();
        $fishCoordinates=FishCoordinate::where('user_id','=',$user)->get();
        return view('user.coordinate.index',['fishCoordinates'=>$fishCoordinates,'fishs'=>$fishs,'fishClasses'=>$fishClasses]);
    }
    public function create(Request $request)
    {
        return response($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coordinate=FishCoordinate::where("id",$id)->find(1);
        return view("user.coordinate.view",["coordinate"=>$coordinate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
