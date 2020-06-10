<?php
#!/bin/bash
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
            ->select('filename', 'url')
            ->leftJoin('users', 'images.user_id', '=', 'users.id')
            ->orderBy('images.created_at', 'desc')
            ->first();
        return response()->json(
            $img
        );
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

        //  $user = JWTAuth::parseToken()->authenticate();
         Image::create([
            'user_id'   => $request->user_id,
            'filename'   => $name,
            'url' => $imagepath
         ]);
         return response()->json([
            'user_id'   => $request->user_id,
            'filename'   => $name,
            'url' => $imagepath
        ]);
    }
}
