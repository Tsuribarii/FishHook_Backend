<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TideInformation extends Model
{
    protected $fillable = [
        'id', 'location','date','high_tide','created_at','updated_at'
    ];
}
