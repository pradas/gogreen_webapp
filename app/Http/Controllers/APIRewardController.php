<?php

namespace App\Http\Controllers;

use App\Reward;
use Illuminate\Http\Request;

class APIRewardController extends APIController
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

    public function index()
    {
        $response = array("rewards" => Reward::all());
        return $this->jsonToUTF($response);
    }

    public function show(Reward $reward)
    {
        return $this->jsonToUTF($reward);
    }
}
