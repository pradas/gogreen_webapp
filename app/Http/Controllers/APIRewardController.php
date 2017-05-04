<?php

namespace App\Http\Controllers;

use App\Reward;
use Tymon\JWTAuth\Facades\JWTAuth;
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
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        $idUserRewards = [];
        foreach ($tokenUser->rewards as $reward){
            $idUserRewards[] = $reward->reward_id;
        }
        $userRewards = Reward::find($idUserRewards);

        $rewards = Reward::all()->sortBy('end_date')->diff($userRewards);

        $response = array("rewards" => $rewards);
        return $this->jsonToUTF($response);
    }

    public function show(Reward $reward)
    {
        return $this->jsonToUTF($reward);
    }

}
