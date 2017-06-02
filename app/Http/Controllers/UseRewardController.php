<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UseRewardController extends Controller
{
    public function useReward(Reward $reward){
        $reward->used = true;
        $reward->save();

        return view('rewards.use', compact('reward'));
    }
}
