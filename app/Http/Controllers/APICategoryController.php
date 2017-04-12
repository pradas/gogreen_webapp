<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Category;
use Illuminate\Http\Request;

class APICategoryController extends APIController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }


    public function index() {
        $response = "{ \"categories\": " . Category::all() . "}";
        return $this->jsonToUTF(Category::all());
    }

    public function index2() {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        return response()->json([
            'data' => [
                'email' => $user->email,
                'registered_at' => $user->created_at->toDateTimeString()
            ]
        ]);
    }
}
