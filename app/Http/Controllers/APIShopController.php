<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;

class APIShopController extends APIController
{
    public function __construct()
    {
        $this->middleware('jwt.auth');

    }

    public function index()
    {
        $response = array("shops" => Shop::all());
        return $this->jsonToUTF($response);
    }

    public function show(Shop $shop)
    {
        return $this->jsonToUTF($shop);
    }

    public function update(Shop $shop, Request $request)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->manager->username == $tokenUser->username) {

            if($this->isValidParameter($request->name)){
                $shop->name = $request->name;
            }
            if($this->isValidParameter($request->email)){
                $shop->email = $request->email;
            }
            if ($this->isValidParameter($request->address)) {
                $shop->addess = $request->address;
            }

            $shop->save();
            return response()->json(['message' => 'Shop updated successfully.']);
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }

    public function destroy(Shop $shop)
    {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->manager->username == $tokenUser->username) {
            $shop->delete();
            return response()->json(['message' => 'Shop deleted successfully.']);
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }
}
