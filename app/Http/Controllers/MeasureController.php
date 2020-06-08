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
        $output = shell_exec("/home/ubuntu/anaconda3/bin/python3 /var/www/html/FishHook_Backend/public/object_size.py  2>&1");
        var_dump($output);
        #$py_path = public_path(). '\object_size.py';
        #$width = 0.955;
        #$result =  shell_exec("sudo /home/ubuntu/anaconda3/bin/python3 " . $py_path . "2>&1");
	#var_dump($result);
        #return response()->json($result);
    }

}
