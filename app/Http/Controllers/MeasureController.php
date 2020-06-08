<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeasureController extends Controller
{

    public function action(){
        // $filename = public_path() . '\object_size.py';
        // if (file_exists($filename)) {
        //     echo "The file $filename exists";
        // } else {
        //     echo "The file $filename does not exist";
        // }

        $py_path = public_path(). '\object_size.py';
        $width = 0.955;
        $result =  shell_exec("sudo python3 " . $py_path);
        // return $result;
        return response()->json($result);
    }

}
