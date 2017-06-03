<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        if ($shop->id == $tokenUser->manages->id) {

            try {
                $deal = new Deal();
                $this->saveDeal($request, $deal);
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

        if ($shop->id == $tokenUser->manages->id) {
            try {
                $this->saveDeal($request, $deal);
                return response()->json(['message' => 'Deal updated successfully.']);

            }
            catch (\Exception $e) {
                return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
            }
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }

    public function saveDeal(Request $request, Deal $deal) {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        $deal->name = $request->name;
        $deal->description = $request->description;
        $deal->value = $request->value;
        $deal->shop_id = $tokenUser->manages->id;
        $deal->date = Carbon::createFromFormat('d-m-Y', $request->date);
        $deal->save();
    }

}
