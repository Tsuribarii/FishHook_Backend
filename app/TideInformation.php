<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TideInformation extends Model
{
    protected $table = 'tide_informations';
    protected $fillable = [
        'id', 'location','date','hide_tide','created_at','updated_at'
    ];

    // 하나의 물때은 여러 글을 가질 수 있다
    public function boards()
    {
        return $this->hasMany('App\Board');
    }
}
