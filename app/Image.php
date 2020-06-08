<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
