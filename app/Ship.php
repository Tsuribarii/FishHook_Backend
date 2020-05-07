<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $fillable = [
        'id', 'owner_id','people','cost','name','departure_time','arrival_time','created_at','updated_at'
    ];

    // 하나의 배는 여러 대여를 가질 수 있다
    public function ship_rentals()
    {
        return $this->hasMany('App\ShipRental');
    }

    // 하나의 업자는 여러 배를 가질 수 있다
    public function ship_owners()
    {
        return $this->belongsTo('App\ShipOwner');
    }
}
