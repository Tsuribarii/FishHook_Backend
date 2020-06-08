<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
// use League\Flysystem\Filesystem;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ImageController extends Controller
{
    public function image()
    {
        $img = DB::table('images')
            ->select('fish_name','filename', 'url')
            ->leftJoin('users', 'images.user_id', '=', 'users.id')
            ->orderBy('images.created_at', 'desc')
            ->first();
        return response()->json(
            $img
        );
    }
    //어종분석
    public function fish_name(Request $request) {
			$output = shell_exec("python3 /home/ubuntu/python/rockfish/main.py 2>&1");
	#$command = escapeshellcmd('/home/ubuntu/python/rockfish/aa.py');
        #$output = Shell_exec($command);
	#$output = shell_exec("python3 --version");    
	$a = strpos($output, '"');
        $result = substr($output,$a+1,-2);
        // return $result;
        var_dump($output);
    }
    //길이분석
    public function action(){
        // $filename = public_path() . '\object_size.py';
        // if (file_exists($filename)) {
        //     echo "The file $filename exists";
        // } else {
        //     echo "The file $filename does not exist";
        // }

        $py_path = public_path(). '\object_size.py';
        $width = 0.955;
        $result =  shell_exec("python " . $py_path);
        // return $result;
        return response()->json($result);
    }

    public function store(Request $request){  
        $this->validate($request, ['image' => 'required|image']);
        if($request->hasfile('image'))
         {
            $file = $request->file('image');
            $name= $file->getClientOriginalName();
            // $filePath = 'image/' . $name;
            // $url = 'https://awsfishhook.s3.ap-northeast-2.amazonaws.com/' . $filePath;
            // Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = $request->file('image')->storeAs('image', $name, 's3');
            $url = Storage::disk('s3')->url($path);
            $imagepath = 'https://awsfishhook.s3.ap-northeast-2.amazonaws.com/image/' .$name;
         }
         $fish_name = $this -> fish_name();
        //  $user = JWTAuth::parseToken()->authenticate();
         Image::create([
            'user_id'   => $user->id,
            'fish_name' => $fish_name,
            'filename'   => $name,
            'url' => $imagepath
         ]);
    }
}
