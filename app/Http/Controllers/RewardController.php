<?php

namespace App\Http\Controllers;

use App\Category;
use App\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RewardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function index(){
        $rewards = Reward::all();
        return view('rewards.index', compact('rewards'));
    }

    public function create(){
        $categories = Category::all();
        return view('rewards.create', compact('categories'));
    }

    public function store(Request $request){
        $validator = $this->validateReward($request);

        if ($validator->fails()) {
            return redirect('/rewards/create')
                ->withInput()
                ->withErrors($validator);
        }

        $reward = new Reward;
        $this->saveReward($request, $reward);

        return redirect('/rewards');
    }

    public function show(Reward $reward){

    }

    public function edit(Reward $reward){
        $categories = Category::all();
        return view('rewards.edit', compact('reward', 'categories'));
    }

    public function update(Request $request, Reward $reward){
        $validator = $this->validateReward($request);

        if ($validator->fails()) {
            return redirect('/rewards/'.$reward->id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $this->saveReward($request, $reward);

        return redirect('/rewards');
    }

    public function destroy(Reward $reward){
        $reward->delete();
        return redirect('/rewards');
    }

    protected function validateReward(Request $request) {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'points' => 'required|numeric',
            'category' => 'required|not_in:0',
            'end_date' => 'required',
            'exchange_info' => 'required',
            'contact_web' => 'required',
            'contact_info' => 'required',
            'exchange_latitude' => 'numeric',
            'exchange_longitude' => 'numeric',
            'reward_image' => 'file|image',
        ]);

        return $validator;
    }

    protected function saveReward(Request $request, Reward $reward) {
        $reward->title = $request->title;
        $reward->description = $request->description;
        $reward->points = $request->points;
        $reward->category_id = $request->category;
        $reward->end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
        if ($request->exchange_date != "")
            $reward->exchange_date = Carbon::createFromFormat('d-m-Y', $request->exchange_date);
        else
            $reward->exchange_date = null;
        $reward->exchange_info = $request->exchange_info;
        $reward->contact_web = $request->contact_web;
        $reward->contact_info = $request->contact_info;
        if ($request->exchange_latitude != "")
            $reward->exchange_latitude = $request->exchange_latitude;
        else
            $reward->exchange_latitude = null;
        if ($request->exchange_longitude != "")
            $reward->exchange_longitude = $request->exchange_longitude;
        else
            $reward->exchange_longitude = null;

        if ($request->hasFile('reward_image')) {
            if ($reward->image != null) {
                Storage::delete($reward->image);
            }
            $reward->image = $request->file('reward_image')->store('rewards');
        }

        $reward->save();
    }
}
