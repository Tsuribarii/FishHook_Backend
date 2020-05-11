<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ranking;
use App\User;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function rank()
    {
        $rank_of_fish = DB::table('rankings')
            ->select('rankings.id','name','fish_name', 'length','photo','location','rankings.created_at')
            ->leftJoin('users', 'rankings.user_id', '=', 'users.id')
            ->orderBy('rankings.length', 'desc')
            ->take(10)
            ->get();
        return response()->json(
            $rank_of_fish
        );
    }
    public function destroy($request, $id)
    {
        //토큰 확인
        $token = $request->header('authorization');
        if($token != ''){
            return response()->json([
                'message' => 'App key not found'
                ], 401);    
        }
        $rank = Ranking::findOrFail($id);
        $rank->delete();
        return response()->json([
            'status' => 'success'
            ], 200);    
    }
    public function create(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'fish_name' => 'required',
            'length' => 'required',
            'photo' => 'required',
            'location' => 'required',
            'created_at' => 'required'
        ]);

        return Ranking::create([
            'user_id'=>\Auth::id(),
            'name' => $request['name'],
            'fish_name' => $request['fish_name'],
            'length' => $request['length'],
            'photo' => $request['photo'],
            'location' => $request['location'],
            'created_at' => $request['created_at']
         ]);

         return response()->json([
            'status' => 'success'
            ], 200);
    }
}
