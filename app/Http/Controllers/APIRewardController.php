<?php

namespace App\Http\Controllers;

use App\Reward;
use Illuminate\Http\Request;

class APIRewardController extends Controller
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
        return "{ \"rewards\": " . Reward::all() . "}";
    }
}
