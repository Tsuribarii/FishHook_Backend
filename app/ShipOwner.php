<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipOwner extends Model
{
    // 하나의 회원는 여러 영업를 가질 수 있다
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // 하나의 업자는 여러 배를 가질 수 있다
    public function ships()
    {
        return $this->hasMany('App\ship');
    }
}
