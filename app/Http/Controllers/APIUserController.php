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
        $this->middleware('jwt.auth');

    }

    public function show($username)
    {
        $user = User::where('username', $username)->first();

        $userInfo = [];
        $userInfo['name'] = $user->name;
        $userInfo['username'] = $user->username;
        $userInfo['total_points'] = $user->total_points;
        $userInfo['created_at'] = $user->created_at;
        $userInfo['email'] = $user->email;
        $userInfo['image'] = $user->image;

        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username == $username) {
            $userInfo['points'] = $tokenUser->points;
            $userInfo['birth_date'] = $tokenUser->birth_date;
        }

        return $this->jsonToUTF($userInfo);
    }
    public function update(Request $request, $username)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        if (isset($request->name)) {
            $tokenUser->name = $request->name;
        }
        if (isset($request->birth_date)) {
            $tokenUser->birth_date = $request->birth_date;
        }
        if (isset($request->email)) {
            $tokenUser->email = $request->email;
        }
        $tokenUser->save();

        return response()->json(['success' => 'User information updated successfully.']);
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
    public function useRewards($username, RewardUser $rewardUser)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $rewardUser->used = true;
        $rewardUser->save();

    }

    public function indexFavouriteRewards($username){
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $response = array("rewards" => $tokenUser->favouriteRewards);
        return $this->jsonToUTF($response);

    }
    public function storeFavouriteRewards(Request $request, $username)
    {

        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favouriteRewards()->attach($request->reward_id);

    }
    public function destroyFavouriteRewards($username,  Reward $reward)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favourite_rewards()->detach($reward->id);

    }
}
