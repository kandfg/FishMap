<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Fish;
use App\Models\FishCoordinate;
use App\Http\Controllers\Controller;
use App\Models\FishClass;
use App\Models\User;
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
        $fishCoordinates=FishCoordinate::where('user_id','=',$user)->orderBy('id','desc')->get();
        return view('user.coordinate.index',['fishCoordinates'=>$fishCoordinates,'fishs'=>$fishs,'fishClasses'=>$fishClasses]);
    }
    public function create(Request $request)
    {
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $result=$user->fishCoordinates()->create([
            'fish_id'=>$request->fish_id,
            'surveyor'=>$request->surveyor,
            'survey_method'=>$request->survey_method,
            'survey_hours'=>$request->survey_hours,
            'survey_day'=>$request->survey_day,
            'abundance'=>$request->abundance,
            'survey_place'=>$request->survey_place,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
        ]);
        $coordinate=FishCoordinate::find($result->id);
        $file = $request->file('cord_image');
        $path = $file->store('public/images');
        $coordinate->images()->create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
        ]);
        return redirect()->back();
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
        $coordinate=FishCoordinate::find($id);
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
        $coordinate=FishCoordinate::find($id);
        $coordinate->delete();
        return Redirect(route('coordinate'));
    }
}
