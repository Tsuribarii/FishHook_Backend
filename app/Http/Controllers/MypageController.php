<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ship;
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
        $this->middleware('auth');

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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->first();
        return view('myabout')->with('user',$user);
    }

    public function checkshow($id)
    {
        $user = User::where('id',$id)->first();
        $ship = Ship::where('id',$id)->first();
        $rental = ShipRental::where('id',$id)->first();
        return view('mycheck')->with('user',$user)->with('ship',$ship)->with('rental',$rental);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('myedit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //프로필 사진
        $request->file('profile_photo')->store('images', 'public');

        User::where('id',$id)->update([
            'profile_photo'=>$request->profile_photo,
            'password'=>$request->password,
            'email'=>$request->email,
            'nickname'=>$request->nickname,
            ]);

        return redirect('myabout/' .$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
