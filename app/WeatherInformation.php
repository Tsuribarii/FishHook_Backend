<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherInformation extends Model
{
    protected $fillable = [
        'id', 'location','temperature','humidity','wind_direction','created_at','updated_at'
    ];
}
