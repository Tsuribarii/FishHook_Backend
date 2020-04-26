<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10',
            'nickname' => 'required|string|unique:users',
            'roles' => 'required|int|',
            'phone_number' => 'required|string|'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'messages' => $validator->messages(),
            ], 200);
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nickname = $request->nickname;
        $user->roles = $request->roles;
        $user->phone_number = $request->phone_number;
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
            ], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'error' => 'invalid.credentials',
                    'msg' => 'Invalid Credentials.'
                ], 400);
        }
        
        return response()->json([
                'status' => 'success'
            ])
            ->header('Authorization', $token);
    }

    //토큰이 있는지 확인하면서 리프레쉬
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
                'status' => 'success',
                'data' => $user
            ]);
    }

    public function refresh()
    {
        return response()->json([
                'status' => 'success'
            ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response()->json([
                'status' => 'success',
                'msg' => 'Logged out Successfully.'
            ], 200);
    }

 
}
