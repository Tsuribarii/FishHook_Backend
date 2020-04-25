<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ShipRental;
use App\Ship;

class ShipController extends Controller
{
    public function __construct()
    {
        //모델과 컨트롤러 연결
        $this->user_model = new User();
        $this->middleware('auth');
    }

    public function create()
    {
        return view('recreate');
    }

    public function shipshow($id)
    {
        $ship = Ship::where('id',$id)->first();
        return response()->json([
            'ship'=>$ship,
        ]);
    }

    public function rentalStore(Request $request)
    {
        ShipRental::create([
            'user_id'=> \Auth::id(),
            'ship_id'=>$request->ship_id,
            'departure_date'=>$request->departure_date,
            'number_of_people'=>$request->number_of_people,
            ]);
            
            return view('reshow');
    }
}
