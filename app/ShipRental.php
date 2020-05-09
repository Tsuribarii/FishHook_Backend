<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipRental extends Model
{
    protected $fillable = [
        'id', 'user_id','ship_id','cancel','departure_date','number_of_people','created_at','updated_at'
    ];
    
    // 하나의 회원는 여러 대여를 가질 수 있다
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // 하나의 배는 여러 대여를 가질 수 있다
    public function ships()
    {
        return $this->belongsTo(Ship::class);
    }
}
