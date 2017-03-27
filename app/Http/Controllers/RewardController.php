<?php

namespace App\Http\Controllers;

use App\Category;
use App\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RewardController extends Controller
{
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
            'points' => 'required|numeric',
            'category' => 'required|not_in:0',
            'end_date' => 'required',
        ]);

        return $validator;
    }

    protected function saveReward(Request $request, Reward $reward) {
        $reward->title = $request->title;
        $reward->points = $request->points;
        $reward->category_id = $request->category;
        $reward->end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
        if ($request->exchange_date != "")
            $reward->exchange_date = Carbon::createFromFormat('d-m-Y', $request->exchange_date);
        else
            $reward->exchange_date = null;

        $reward->save();
    }
}
