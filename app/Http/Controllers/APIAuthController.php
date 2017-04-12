<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;

class APIAuthController extends Controller
{

    public function signup(Request $request) {

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        } catch (Exception $e) {
            return response()->json(['error' => 'User already exists.'], Response::HTTP_CONFLICT);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function signin(Request $request){
        $credentials = $request->only('email', 'password');

        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response()->json(false, Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(compact('token'));
    }
}
