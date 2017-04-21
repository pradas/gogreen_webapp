<?php

namespace App\Http\Controllers;

use App\Reward;
use App\RewardUser;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIUserController extends APIController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('jwt.auth');

    }

    public function indexRewards($username)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $response = array("rewards" => $tokenUser->rewards);
        return $this->jsonToUTF($response);
    }

    public function storeRewards(Request $request, $username)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $requestReward = Reward::find($request->reward_id);

        $tokenUser->points -= $requestReward->points;
        $tokenUser->save();

        $rewardUser = new RewardUser;
        $rewardUser->user_id = $tokenUser->id;
        $rewardUser->reward_id = $requestReward->id;
        $rewardUser->save();

    }
    public function destroyRewards($username, $reward)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

    }
    public function storeFavoriteRewards(Request $request, $username)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

    }
    public function destroyFavoriteRewards($username, $favoriteReward)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

    }
}
