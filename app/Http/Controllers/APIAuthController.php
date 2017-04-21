<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            $user->username = $request->username;
            $user->birth_date = Carbon::createFromFormat('d-m-Y', $request->birth_date);
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = '4';
            $user->points = 1000;
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'User already exists.'], Response::HTTP_CONFLICT);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function signin(Request $request){

        $user = User::where('username', $request->user)->first();

        if($user == null)
            $user = User::where('email', $request->user)->first();

        $credentials = array("email" => $user->email, "password" => $request->password);

        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Wrong mail or password.'], Response::HTTP_UNAUTHORIZED);
        }

        $role = $user->role->name;

        return response()->json(compact('token','role'));
    }
}
