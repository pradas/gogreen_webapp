<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Event;
use App\Reward;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class APIFavouriteController extends APIController
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

    public function indexRewards($username){
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $response = array("rewards" => $tokenUser->favouriteRewards);
        return $this->jsonToUTF($response);

    }
    public function storeRewards(Request $request, $username)
    {

        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favouriteRewards()->attach($request->reward_id);
        return response()->json(['message' => 'User favourited a reward successfully.']);

    }
    public function destroyRewards($username,  Reward $reward)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favouriteRewards()->detach($reward->id);
        return response()->json(['message' => 'User unfavourited a reward successfully.']);

    }

    public function indexEvents($username){
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $response = array("events" => $tokenUser->favouriteEvents);
        return $this->jsonToUTF($response);

    }
    public function storeEvents(Request $request, $username)
    {

        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favouriteEvents()->attach($request->event_id);
        return response()->json(['message' => 'User favourited an event successfully.']);

    }
    public function destroyEvents($username, Event $event)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favouriteEvents()->detach($event->id);
        return response()->json(['message' => 'User unfavourited an event successfully.']);

    }

    public function indexDeals($username){
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $response = array("deals" => $tokenUser->favouriteDeals);
        return $this->jsonToUTF($response);

    }
    public function storeDeals(Request $request, $username)
    {

        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favouriteDeals()->attach($request->deal_id);
        return response()->json(['message' => 'User favourited a deal successfully.']);

    }
    public function destroyDeals($username, Deal $deal)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        if ($tokenUser->username != $username)
            return response()->json(['error' => 'Invalid authorization.'], Response::HTTP_CONFLICT);

        $tokenUser->favouriteDeals()->detach($deal->id);
        return response()->json(['message' => 'User unfavourited a deal successfully.']);

    }
}
