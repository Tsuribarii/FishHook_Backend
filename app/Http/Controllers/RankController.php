<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ranking;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function fish_name() {
        $output = shell_exec("python C:/Users/PC/jekim/rockfish/rockfish/main.py");
        $a = strpos($output, '"');
        $result = substr($output,$a+1,-2);
        return $result;
    }
    public function store(Request $request)
    {
        $request->validate([
            'length'    => 'required',
            'photo'     => 'required',
            'location'  => 'required'
        ]);
        $fish_name = $this -> fish_name();
        $ranking = new Ranking([
            'user_id'   => auth()->id(),
            'fish_name' => $fish_name,
            'length'    => $request->get('length'),
            'photo'     => $request->get('photo'),
            'location'  => $request->get('location')
        ]);
        $ranking->save();
        return response()->json(['status' => 'success'], 200);
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
}
