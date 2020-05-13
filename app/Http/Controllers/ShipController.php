<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Auth;
use App\User;
use App\ShipRental;
use App\Ship;
use App\ShipOwner;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\DB;

class ShipController extends Controller
{
    public function __construct()
    {
        //모델과 컨트롤러 연결
        $this->user_model = new User();
        // $this->middleware('auth.jwt');
    }
    
    public function create()
    {
        //
    }

    //ship리스트
    public function index()
    {
        $ship = DB::table('ship_owners')
        ->join('ships','ship_owners.id','=','ships.owner_id')
        ->select('ships.id','owner_id','people','cost','name','departure_time','arrival_time','ship_image',
                'ship_owners.owner_name','location')
        // ->latest()
        ->paginate(10);
        return response()->json($ship);
    }

    //ship상세정보
    public function shipshow($id)
    {
        $ship = DB::table('ship_owners')
        ->join('ships','ship_owners.id','=','ships.owner_id')
        ->where('ships.id',$id)
        ->select('ships.id','owner_id','people','cost','name','departure_time','arrival_time','ship_image',
                'ship_owners.owner_name','location','business_time','homepage')
        ->first();

        return response()->json($ship);
    }

    //영업 등록
    public function ownerStore(Request $request)
    {
        \Log::debug($request);
        $this->validate($request, [
            'owner_name' => 'required',
            'location' => 'required',
            'business_time' => 'required',
            'homepage' => 'required',
        ]);

        $shipowner = new ShipOwner([
            'user_id'=>Auth::user()->id,
            'owner_name' => $request['owner_name'],
            'location' => $request['location'],
            'business_time' => $request['business_time'],
            'homepage' => $request['homepage'],
            'ship_image' => $request['ship_image'],
            ]);

        $shipowner->save();
            
        return response()->json([
            'status' => 'success',
        ]);
    }

    //배 등록
    public function shipStore(Request $request)
    {
        // \Log::debug($request);
        $this->validate($request, [
            'people' => 'required',
            'cost' => 'required',
            'name' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
        ]);

        $ship = new Ship([
            //shipowner테이블의 id를 받아옴
            'owner_id' =>ShipOwner::where('user_id',Auth::id())->first()->id,
            'people' => $request['people'],
            'cost' => $request['cost'],
            'name' => $request['name'],
            'departure_time' => $request['departure_time'],
            'arrival_time' => $request['arrival_time'],
            'ship_image' => $request['ship_image'],
            ]);

        //배 이미지
        if ($request->hasFile('ship_image')) {
            $image = $request->file('ship_image');
            $name = $image->getClientOriginalName();
            $destinationPath = ('/var/www/html/FishHook_Back/public/images');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $ship->ship_image = $name;
            }

        $ship->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
    
    //예약
    public function rentalStore(Request $request)
    {
        \Log::debug($request);
        $this->validate($request, [
            'departure_date' => 'required',
            'number_of_people' => 'required',
        ]);

        $rental = new ShipRental([
            'user_id'=>Auth::user()->id,
            'ship_id' => $request['ship_id'],
            'departure_date' => $request['departure_date'],
            'number_of_people' => $request['number_of_people']
            ]);

        $rental->save();
            
        return response()->json([
            'status' => 'success',
        ]);
    }
}
