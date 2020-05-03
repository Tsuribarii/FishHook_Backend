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
            ->select('fish_name', 'length','photo','location','rankings.created_at','name')
            ->leftJoin('users', 'rankings.user_id', '=', 'users.id')
            ->get();
        return response()->json([
            'rank_of_fish'=>$rank_of_fish
        ]);
    }
    public function destroy($id)
    {
        $rank = Ranking::findOrFail($id);
        $rank->delete();
        return response()->json([
            'status' => 'success'
            ], 200);    
    }
}
