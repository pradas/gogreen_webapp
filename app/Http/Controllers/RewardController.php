<?php

namespace App\Http\Controllers;

use App\Category;
use App\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index(){

    }

    public function create(){
        $categories = Category::all();
        return view('rewards.create')->with('categories', $categories);
    }

    public function store(Request $request){
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'points' => 'required|numeric',
            'category' => 'required|not_in:0',
            'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/rewards/create')
                ->withInput()
                ->withErrors($validator);
        }

        $reward = new Reward;
        $reward->title = $request->title;
        $reward->points = $request->points;
        $reward->category_id = $request->category;
        $reward->end_date = Carbon::createFromFormat('d/m/Y', $request->end_date);
        if ($request->exchange_date != "")
            $reward->exchange_date = Carbon::createFromFormat('d/m/Y', $request->exchange_date);

        $reward->save();

        return redirect('/rewards/create');

    }

    public function show(Reward $reward){

    }

    public function edit(Reward $reward){

    }

    public function update(Reward $reward){

    }

    public function destroy(Reward $reward){
        $reward->delete();
    }
}
