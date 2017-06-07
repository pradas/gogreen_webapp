<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class APIEmployeeController extends APIController
{
    public function __construct()
    {
        $this->middleware('jwt.auth');

    }

    public function index(Shop $shop)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        $response = array("employees" => $shop->employees);
        return $this->jsonToUTF($response);
    }

    public function store(Shop $shop, Request $request)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->id == $tokenUser->manages->id) {
            $user = new User;
            $user->name = "Empleado";
            $user->username = $request->username;
            $user->birth_date = \Carbon\Carbon::now();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = '3';
            $user->shop_id = $shop->id;
            $user->save();
            return response()->json(['message' => 'User created successfully.'], Response::HTTP_CREATED);
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }

    public function destroy(Shop $shop, $username)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->id == $tokenUser->manages->id) {
            $user = User::where('username', $username);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);

    }
}
