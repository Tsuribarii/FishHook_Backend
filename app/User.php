<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTsubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    # request->all()함수를 사용했을 시 할당할 데이터 (대량할당), 이 이외의 칼럼값은 가져오지 않음.
    protected $fillable = [
        'id', 'email', 'password','name','roles','phone_number','profile_photo','created_at','updated_at'
    ];

    public function getProfilepictureFilenameAttribute()
    {
        if (! $this->attributes['profile_photo']) {
            return '/images/default.jpg';
        }

        return $this->attributes['profile_photo'];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getImageAttribute()
    {
        return $this->profile_photo;
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 하나의 회원은 여러 글을 가질 수 있다
    public function boards()
    {
        return $this->hasMany('App\Board');
    }

    // 하나의 회원은 여러 댓글을 가질 수 있다
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // 하나의 회원은 여러 배 영업을 가질 수 있다
    public function ship_owners()
    {
        return $this->hasMany('App\ShipOwner');
    }

    // 하나의 회원은 여러 배 대여를 가질 수 있다
    public function ship_rentals()
    {
        return $this->hasMany('App\ShipRental');
    }

    // 하나의 회원은 여러 랭킹을 가질 수 있다
    public function rakings()
    {
        return $this->hasMany('App\Ranking');
    }
    // 하나의 회원은 여러 랭킹을 가질 수 있다
    public function images()
    {
        return $this->hasMany('App\Image');
    }
    // 하나의 회원은 여러 영업 장소을 가질 수 있다
    public function fishing_places()
    {
        return $this->hasMany('App\FishingPlace');
    }


}
