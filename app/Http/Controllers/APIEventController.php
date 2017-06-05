<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class APIEventController extends APIController
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
        $response = array("events" => Event::all());
        return $this->jsonToUTF($response);
    }
    public function indexShops(Shop $shop)
    {
        $response = array("events" => $shop->events);
        return $this->jsonToUTF($response);
    }
    public function store(Request $request, Shop $shop) {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        //var_dump($shop->id);

        if ($shop->id == $tokenUser->manages->id) {
            try {
                $event = new Event;
                $this->saveEvent($request, $event);
                return response()->json(['message' => 'Event created successfully.']);

            }
            catch (\Exception $e) {
                return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
            }
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }
    public function show(Event $event) {
        return $this->jsonToUTF($event);
    }
    public function showShops(Shop $shop, Event $event)
    {
        return $this->jsonToUTF($event);
    }
    public function update(Request $request,Shop $shop, Event $event) {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->id == $tokenUser->manages->id) {
            try {
                $this->saveEvent($request, $event);
                return response()->json(['message' => 'Event edited successfully.']);

            }
            catch (\Exception $e) {
                return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
            }
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }
    public function destroy(Shop $shop, Event $event) {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        if ($shop->id == $tokenUser->manages->id) {
            $event->favouritedBy()->detach();
            $event->delete();
            return response()->json(['message' => 'Event deleted successfully.']);
        }
        return response()->json(['message' => 'You d\'ont have permisions.'], Response::HTTP_UNAUTHORIZED);
    }
    public function saveEvent(Request $request, Event $event) {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);

        $event->title = $request->title;
        $event->description = $request->description;
        $event->points = $request->points;
        $event->shop_id = $tokenUser->manages->id;
        if ($this->isValidParameter($request->adress)) {
            $event->adress = $request->adress;
        }
        if ($this->isValidParameter($request->date) and $this->isValidParameter($request->time)) {
            $event->date = Carbon::createFromFormat('d-m-Y H:i', $request->date.' '.$request->time);
        }
        if ($this->isValidParameter($request->image)) {
            $event->image = $request->image;
        }
        else if (!$this->isValidParameter($event->id)) {
            $event->image = self::DEFAULT_EVENT_IMAGE;
        }
        if ($this->isValidParameter($request->category)) {
            $event->category_id = Category::where('name', $request->category)->first()->id;
        }
        //if ($request->hasFile('image')) {
        //    $event->image = $request->file('image')->store('events');
        //}
        $event->save();
    }
}
