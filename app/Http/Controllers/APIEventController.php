<?php

namespace App\Http\Controllers;

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
            if ($this->isValidParameter($request->category_id)) {
                $event->category_id = $request->category_id;
            }
            //if ($request->hasFile('image')) {
            //    $event->image = $request->file('image')->store('events');
            //}
            $event->save();

            return response()->json(['message' => 'Event created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
        }

    }
}
