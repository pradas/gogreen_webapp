<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIEventController extends Controller
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

    public function store(Request $request) {

        //try {
            $event = new Event;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->points = $request->points;
            $event->adress = $request->adress;
            $event->company = $request->company;
            $event->date = Carbon::createFromFormat('d-m-Y H:i', $request->date.' '.$request->time);
            $event->image = $request->file('image')->store('events');
            $event->save();
        //} catch (\Exception $e) {
        //    return response()->json(['error' => 'Something went wrong.'], Response::HTTP_NOT_ACCEPTABLE);
        //}

    }
}
