<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\functions\storelocator;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function show(){
        
        include(app_path() . '\functions\storelocator.php');
        $store = getStore();
        return $store;
    }

}
