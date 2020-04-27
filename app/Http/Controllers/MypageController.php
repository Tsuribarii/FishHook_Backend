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
        // $this->middleware('auth');

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
    public function show($id)
    {
        $user = User::where('id',$id)->first();
        return response()->json([
            'user'=>$user,
        ]);
    }

    public function checkshow($id)
    {
        $user = User::where('id',$id)->first();
        $ship = Ship::where('id',$id)->first();
        $rental = ShipRental::where('id',$id)->first();
        return response()->json([
            'user'=>$user,
            'ship'=>$ship,
            'rental'=>$rental
        ]);
    }

    /**edit
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
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
    public function update(Request $request, $id)
    {
        //프로필 사진
        // $request->file('profile_photo')->store('images', 'public');

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        
        $this->validate($request, [
            'password' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update($request->all());

        return response()->json([
            'message' => '업데이트 되었습니다.'
           ]);

        // return redirect('myabout/' .$id);
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
