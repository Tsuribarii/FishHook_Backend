<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishingPlace extends Model
{
    protected $table = 'fishing_places';
    protected $fillable = [
        'id', 'user_id','place_name','location','fishing_type','phone_number','people','available_time','homepage','place_photo','main_fish_species','main_fish_image','created_at','updated_at'
    ];

    //하나의 회원는 여러 영업 장소를 가질 수 있다
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}