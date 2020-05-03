<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\ShipRental;
use App\ShipOwner;
use App\Ship;

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
        // \Log::debug($request);
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

    public function shipshow($id)
    {
        $ship = Ship::where('id',$id)->first();
        return response()->json([
            'ship'=>$ship,
        ]);
    }

    public function shipStore(Request $request)
    {
        \Log::debug($request);
        $this->validate($request, [
            'people' => 'required',
            'cost' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
        ]);

        $ship = new Ship([
            'owner_id'=>Auth::user()->id,
            'people'=>$request['people'],
            'cost'=>$request['cost'],
            'departure_time'=>$request['departure_time'],
            'arrival_time'=>$request['arrival_time'],
            ]);

        $ship->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
