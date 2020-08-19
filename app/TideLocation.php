<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TideLocation extends Model
{
    protected $table = 'tide_locations';
    protected $fillable = [
        'id','location','image','temperature'
    ];
    
}
