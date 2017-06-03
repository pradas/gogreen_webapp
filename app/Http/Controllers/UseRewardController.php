<?php

namespace App\Http\Controllers;

use App\RewardUser;
use Illuminate\Http\Request;

class UseRewardController extends Controller
{
    public function useReward(RewardUser $reward){
        $reward->used = true;
        $reward->save();

        return view('rewards.use', compact('reward'));
    }
}
