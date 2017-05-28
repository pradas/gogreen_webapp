<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Shop;
use Illuminate\Http\Request;

class APIDealController extends APIController
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
        $response = array("deals" => Deal::all());
        return $this->jsonToUTF($response);
    }
    public function indexShops(Shop $shop)
    {
        $response = array("deals" => $shop->deals);
        return $this->jsonToUTF($response);
    }
    public function store(Shop $shop, Request $request)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->manager->username == $tokenUser->username) {
            try {
                $deal = new Deal();
                $this->saveEvent($request, $deal);
                return response()->json(['message' => 'Deal created successfully.']);

            }
            catch (\Exception $e) {
                return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
            }
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }
    public function show(Deal $deal)
    {
        return $this->jsonToUTF($deal);
    }
    public function showShops(Shop $shop, Deal $deal)
    {
        return $this->jsonToUTF($deal);
    }
    public function update(Shop $shop, Deal $deal, Request $request)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->manager->username == $tokenUser->username) {
            try {
                $this->saveEvent($request, $deal);
                return response()->json(['message' => 'Deal updated successfully.']);

            }
            catch (\Exception $e) {
                return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
            }
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }

    public function saveEvent(Request $request, Deal $deal) {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        $deal->title = $request->title;
        $deal->description = $request->description;
        $deal->value = $request->value;
        $deal->shop_id = $tokenUser->manages->id;
        $deal->date = Carbon::createFromFormat('d-m-Y', $request->date);
        $deal->save();
    }

}
