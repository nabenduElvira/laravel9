<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     public function login(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            $user= Auth::user();
            $token = $user->createToken('app')->accessToken;
            return response([
                'message'=>'login success',
                'token'=>$token,
                'user'=>$user
            ],200);
        }

        return response([
            'message'=>'login not success',
        ],401);
    }


    public function register(Request $request)
    {
        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        $token = $user->createToken('app')->accessToken;
        return response([
            'message'=>'registration success',
                'token'=>$token,
                'user'=>$user
        ],200);
    }


    // public function login2(Request $request)
    // {

    //     try {
    //         if(Auth::attempt($request->only('email','password'))){
    //             $user= Auth::user();
    //             $token = $user->createToken('app')->accessToken;
    //             return response([
    //                 'message'=>'login success',
    //                 'token'=>$token,
    //                 'user'=>$user
    //             ],200);
    //         }
    //     } catch (Exception $exception) {
    //          return response([
    //             'message'=> $exception->getMessage(),
    //          ],400);
    //     }
    //     return response([
    //         'message'=>'login not success',
    //     ],401);
    // }
}