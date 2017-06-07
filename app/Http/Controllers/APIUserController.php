<?php

namespace App\Http\Controllers;

use App\Event;
use App\Reward;
use App\RewardUser;
use App\User;
use Carbon\Carbon;
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
        if ($tokenUser->username != $username) {
            $user = User::where('username', $username)->first();
            if ($user == null)
                return response()->json(['error' => $username.' not found'], Response::HTTP_NOT_FOUND);
            if ($tokenUser->hasRole('manager') or $tokenUser->hasRole('shopper')) {
                if ($this->isValidParameter($request->points)) {
                    $user->points += (int)$request->points;
                    $user->total_points += (int)$request->points;
                }
                $user->save();
                return response()->json(['message' => 'User information updated successfully.']);
            }

            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_UNAUTHORIZED);
        }

        if ($this->isValidParameter($request->points)) {
            return response()->json(['error' => 'Invalid parameter.'], Response::HTTP_BAD_REQUEST);
        }

        if ($this->isValidParameter($request->name)) {
            $tokenUser->name = $request->name;
        }
        if ($this->isValidParameter($request->birth_date)) {
            $tokenUser->birth_date = Carbon::createFromFormat('d-m-Y', $request->birth_date);
        }
        if ($this->isValidParameter($request->email)) {
            $tokenUser->email = $request->email;
        }
        if ($this->isValidParameter($request->image)) {
            $tokenUser->image = $request->image;
        }
        if ($this->isValidParameter($request->password)) {
            $tokenUser->password = bcrypt($request->password);
        }

        $tokenUser->save();

        return response()->json(['message' => 'User information updated successfully.']);
    }

    public function indexRewards($username)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $response = array("rewards" => $tokenUser->rewards()->where('used', 0)->get());
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

        return response()->json(['message' => 'User exchanged a reward successfully.']);


    }
    public function useRewards($username, RewardUser $rewardUser)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $rewardUser->used = true;
        $rewardUser->save();
        return response()->json(['message' => 'User used a reward successfully.']);

    }

}
