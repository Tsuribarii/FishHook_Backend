<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\functions\storelocator;

class StoreController extends Controller
{
    public function store()
{
    include(app_path() . '\functions\storelocator.php');
    // return response()->json($store);
}
}
