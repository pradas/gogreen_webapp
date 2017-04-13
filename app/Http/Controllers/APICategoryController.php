<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Category;

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
        $this->middleware('api.role:administrator|user');
    }

    public function index() {
        $response = "{ \"categories\": " . Category::all() . "}";
        return $this->jsonToUTF(Category::all());
    }

}
