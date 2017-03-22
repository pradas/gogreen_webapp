<?php

namespace App\Http\Controllers;

use App\Reward;
use Illuminate\Http\Request;

class APIRewardController extends Controller
{
    public function index() {
        return Reward::all();
    }
}
