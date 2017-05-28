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
            $user->image = self::DEFAULT_IMAGE;
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'User already exists.'], Response::HTTP_CONFLICT);
        }

        $token = JWTAuth::fromUser($user);
        $points = $user->points;

        return response()->json(compact('token', 'points'));
    }

    public function signin(Request $request){

        $user = User::whereRaw("BINARY `username`= ?", [$request->user])->first();

        if($user == null)
            $user = User::where('email', $request->user)->first();

        try {
            $credentials = array("email" => $user->email, "password" => $request->password);

            if ( ! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Wrong mail or password.'], Response::HTTP_UNAUTHORIZED);
            }
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Wrong mail or password.'], Response::HTTP_UNAUTHORIZED);
        }

        $role = $user->role->name;
        $points = $user->points;

        return response()->json(compact('token','role', 'points'));
    }
}
