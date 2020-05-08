<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
// use App\Http\Controllers\DB;
use App\User;
use App\Ship;
use App\ShipOwner;
use Auth;
use App\ShipRental;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //모델과 컨트롤러 연결
        $this->user_model = new User();
        // $this->middleware('jwt.auth');

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        // $user = Auth::find($id);
        return response()->json($user);
    }

    public function checkshow()
    {
        //대여자의 예약현황 (예약정보, 유저정보)
        
        if(Auth::user()->roles=='2'){
            
            $ship_id = ShipOwner::where('user_id',Auth::id())->first()->ships->first()->id;
            $rental = DB::table('ship_rentals')
                ->where('ship_id',$ship_id)
                ->join('users','ship_rentals.user_id','=','users.id')
                ->select('ship_rentals.id','ship_id','departure_date','number_of_people','ship_rentals.created_at','users.id','users.name')
                ->get();
            
            return response()->json($rental);

        // 일반유저의 예약현황 (예약정보, 배정보)
        }else{

            // $ship_id = ShipOwner::where('user_id',Auth::id())->first()->ships->first()->id;
            $rental = DB::table('ship_rentals')
                ->where('user_id',Auth::id())
                ->join('ships','ship_rentals.ship_id','=','ships.id')
                ->select('ship_rentals.id','ship_id','departure_date','number_of_people','ship_rentals.created_at','ships.id','ships.name','ships.cost')
                ->get();
       
            return response()->json($rental);
        }
    }

    /**edit
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'user'=>$user,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 
        // \Log::debug($request->all());
        $this->validate($request, [
            'password' => 'required',
            'phone_number' => 'required',
        ]);
        
        $user = User::find(Auth::user()->id);
        $currentphoto = $user->profile_photo;
          if ($request->photo != $currentphoto) {
              $image = $request->file('profile_photo');
              $name = $image->getClientOriginalName();
              $destinationPath = public_path('/images');
              $imagePath = $destinationPath. "/".  $name;
              $image->move($destinationPath, $name);
              $user->profile_photo = $name;
            }
            
            $user->update($request->all());
            // $user->save();
            
            return response()->json([
                'status' => 'success'
                ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = User::find(Auth::user()->id)
            // ->where('profile_photo')
            ->update(['profile_photo'=>'default.jpg']);
            
        return response()->json([
            'status' => 'success'
            ], 200);
    }
}
