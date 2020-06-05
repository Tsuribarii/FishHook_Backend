<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeasureController extends Controller
{

    public function action(){
        // $filename = public_path() . '\object_size.py';
        // if (file_exists($filename)) {
        //     echo "The file $filename exists";
        // } else {
        //     echo "The file $filename does not exist";
        // }

        $image_path = public_path() . '\images\example_12.png';
        $py_path = public_path(). '\object_size.py';
        $width = 0.955;
        $result =  shell_exec("python " . $py_path .' --image '. $image_path .' --width '. $width);
        return $result;
    }

}
