<?php

namespace App\Http\Controllers;
use Request;
use App\Ranking;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RankController extends Controller
{
    public function create(){
        return view('images.create');
    }
    public function rank()
    {
        $rank_of_fish = DB::table('rankings')
            ->select('rankings.id','name','fish_name', 'length','photo','location','rankings.created_at')
            ->leftJoin('users', 'rankings.user_id', '=', 'users.id')
            ->orderBy('rankings.length', 'desc')
            ->take(10)
            ->paginate(4);
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
        
        if($request->hasfile('image'))
         {
            $file = $request->file('image');
            $name=time().$file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $url = "https://s3.ap-northeast-2.amazonaws.com/awsfishhook/".$name;
         }
        // $path = $request->file('image')->store('images','s3');
        // Storage::disk('s3')->setVisibility($path, 'private');
        // var_dump($request);
        // echo "pf";
        // $image = $request->file('image');
        // $imageFileName = time() . '.' . $image->getClientOriginalExtension();
        // $s3 = \Storage::disk('s3');
        // $filePath = '/awsfishhook/' . $imageFileName;
        // $s3->put($filePath, file_get_contents($image), 'public');
        // $url = "https://s3.ap-northeast-2.amazonaws.com/awsfishhook/".$imageFileName;
        // $fish_name = $this -> fish_name();
        // $input = $request->all();
        // if($input) {
        //     $uploadFile = $request::file($uploadName);
        //     if(is_array($uploadFile)) {
        //         foreach($uploadFile as $file) {
        //             $url = "";
        //             $now = date("Y-m-d H:i:s");
        //             $tempFileName = $uuidLibrary->createUUID();
        //             $fileSize = $file->getClientSize();
        //             $fileRealName = $file->getClientOriginalName();
        //             $fileExtension = $file->getClientOriginalExtension();
        //             $filePath = Storage::disk('s3')->put($uploadFolder.$tempFileName,file_get_contents($file),'public');
        //             $url = $s3URL.'/'.$uploadFolder.$tempFileName;
        //         }

        //     } else {
        //         $url = "";
        //         $now = date("Y-m-d H:i:s");
        //         $tempFileName = $uuidLibrary->createUUID();
        //         $fileSize = $request::file($uploadName)->getClientSize();
        //         $fileRealName = $request::file($uploadName)->getClientOriginalName();
        //         $fileExtension = $request::file($uploadName)->getClientOriginalExtension();
        //         $filePath = Storage::disk('s3')->put($uploadFolder.$tempFileName,file_get_contents($request::file($uploadName)),'public');
        //         $url = $s3URL.$uploadFolder.$tempFileName;
        //     }
        // }
        $user = JWTAuth::parseToken()->authenticate();
        $ranking = new Ranking([
            'user_id'   => $user->id,
            'fish_name' => $fish_name,
            'length'    => $request->get('length'),
            'photo'     => $url,
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
