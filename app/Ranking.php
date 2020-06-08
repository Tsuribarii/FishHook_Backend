<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $fillable = [
        'user_id','fish_name', 'length','photo','location','created_at'
    ];
    // 하나의 회원은 여러 랭킹을 가질 수 있다
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
