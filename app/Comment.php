<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id', 'comment_writer_id', 'post_id','content','created_at','updated_at'
    ];

    // 하나의 글은 여러 댓글을 가질 수 있다
    public function boards()
    {
        return $this->belongsTo(Board::class);
    }

    // 하나의 회원은 여러 댓글을 가질 수 있다
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
