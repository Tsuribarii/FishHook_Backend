<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Auth;
use App\User;
use App\ShipRental;
use App\Ship;
use App\ShipOwner;
use App\Http\Controllers\DB;

class ShipController extends Controller
{
    public function __construct()
    {
        //모델과 컨트롤러 연결
        $this->user_model = new User();
        // $this->middleware('auth.jwt');
    }

    public function ownerStore(Request $request)
    {
        \Log::debug($request);
        $this->validate($request, [
            'location' => 'required',
            'business_time' => 'required',
            'homepage' => 'required',
        ]);

        $shipowner = new ShipOwner([
            'user_id'=>Auth::user()->id,
            'location' => $request['location'],
            'business_time' => $request['business_time'],
            'homepage' => $request['homepage']
            ]);

        $shipowner->save();
            
        return response()->json([
            'status' => 'success',
        ]);
    }
    
    public function create()
    {
        //
    }

    public function shipshow()
    {
        $ship = Ship::where('id',1)->first();
        return response()->json([
            'ship'=>$ship,
        ]);
    }
    //미완
    public function shipStore(Request $request)
    {
        \Log::debug($request);
        $this->validate($request, [
            'people' => 'required',
            'cost' => 'required',
            'name' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
        ]);
        $user = Auth::user()->id;
        // $owner = ShipOwner::where('user_id',Auth::id())->first()->ships->first()->id;
        return $owner;
        $ship = new Ship([
            //아이디 받아오는 부분 미완
            // 'owner_id'=>Auth::user()->id,
            'owner_id' =>ShipOwner::where('user_id',Auth::id())->first()->ships->first()->id,
            'people' => $request['people'],
            'cost' => $request['cost'],
            'name' => $request['name'],
            'departure_time' => $request['departure_time'],
            'arrival_time' => $request['arrival_time'],
            ]);

        $ship->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
    //미완
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
