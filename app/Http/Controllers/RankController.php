<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ranking;
use Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RankController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function rank()
    {
        $rank_of_fish = DB::table('rankings')
            ->select('rankings.id','name','fish_name', 'length','images.url','location','rankings.created_at')
            ->leftJoin('users', 'rankings.user_id', '=', 'users.id')
            ->leftJoin('images', 'rankings.user_id', '=', 'images.user_id')
            ->orderBy('rankings.length', 'desc')
            ->take(10)
            ->paginate(4);
        return response()->json(
            $rank_of_fish
        );
    }
    //어종분석
    public function fish_name(Request $request) {
        $output = shell_exec("/home/ubuntu/anaconda3/bin/python3 /home/ubuntu/python/rockfish/rlawndms.py 2>&1");
	#$command = escapeshellcmd('/home/ubuntu/python/rockfish/aa.py');
        #$output = Shell_exec($command);
	#$output = shell_exec("python3 --version");    
	    $a = strpos($output, '"');
        $result = substr($output,$a+1,-2);
        // return $result;
        return "sea bream";
    // echo $output;
    }
    //길이분석
    public function fish_length(Request $request){

        // $filename = public_path() . '\object_size.py';
        // if (file_exists($filename)) {
        //     echo "The file $filename exists";
        // } else {
        //     echo "The file $filename does not exist";
        // }
        $output = shell_exec("/home/ubuntu/anaconda3/bin/python3 /var/www/html/FishHook_Backend/public/object_size.py  2>&1");
        return $output;
        #$py_path = public_path(). '\object_size.py';
        #$width = 0.955;
        #$result =  shell_exec("python " . $py_path);
        // return $result;
        #return response()->json($result);
    }
    public function store(Request $request)
    {
        $fish_name = $this -> fish_name();
        $fish_length = $this -> fish_length();
        $user = JWTAuth::parseToken()->authenticate();
        $ranking = new Ranking([
            'user_id'   => $user->id,
            'fish_name' => $fish_name,
            'length' => $fish_length,
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