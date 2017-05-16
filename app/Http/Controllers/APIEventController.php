<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function store(Request $request) {
        try {
            $event = new Event;
            $this->saveEvent($request, $event);
            return response()->json(['message' => 'Event created successfully.']);

        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function show(Event $event) {
        return $this->jsonToUTF($event);
    }
    public function update(Request $request, Event $event) {
        try {
            $this->saveEvent($request, $event);
            return response()->json(['message' => 'Event created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function saveEvent(Request $request, Event $event) {
        $event->title = $request->title;
        $event->description = $request->description;
        $event->points = $request->points;
        if ($this->isValidParameter($request->adress)) {
            $event->adress = $request->adress;
        }
        if ($this->isValidParameter($request->company)) {
            $event->company = $request->company;
        }
        if ($this->isValidParameter($request->date) and $this->isValidParameter($request->time)) {
            $event->date = Carbon::createFromFormat('d-m-Y H:i', $request->date.' '.$request->time);
        }
        if ($this->isValidParameter($request->image)) {
            $event->image = $request->image;
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
