<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class APICategoryController extends APIController
{
    public function index() {
        $response = "{ \"categories\": " . Category::all() . "}";
        return $this->jsonToUTF(Category::all());
    }
}
