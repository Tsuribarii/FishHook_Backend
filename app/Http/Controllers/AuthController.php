<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // \Log::debug($request);
        $validator = Validator::make($request->json()->all() , [
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6', 
            'name' => 'required|string',
            'roles' => 'required',
            'phone_number' => 'required'
            
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'email' => $request->json()->get('email'),
            'password' => Hash::make($request->json()->get('password')),
            'name' => $request->json()->get('name'),
            'roles' => $request->json()->get('roles'),
            'phone_number' => $request->json()->get('phone_number'),
            
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function login(Request $request)
    {
        \Log::debug($request);
        $credentials = $request->json()->all();

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json( compact('token') );
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    //토큰이 있는지 확인하면서 리프레쉬
    // public function user(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     return response()->json([
    //             'status' => 'success',
    //             'data' => $user
    //         ]);
    // }

    // public function refresh()
    // {
    //     return response()->json([
    //             'status' => 'success'
    //         ]);
    // }

    // public function logout()
    // {
    //     JWTAuth::invalidate();
    //     return response()->json([
    //             'status' => 'success',
    //             'msg' => 'Logged out Successfully.'
    //         ], 200);
    // }

 
}
