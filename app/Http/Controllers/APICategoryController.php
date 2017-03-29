<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class APICategoryController extends Controller
{
    public function index() {
        return "{ \"categories\": " . Category::all() . "}";
    }
}
