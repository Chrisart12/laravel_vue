<?php

namespace App;

use App\Comment;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['url', 'name', 'body', 'comment_id'];
    protected $appends = ['human_created_at'];
    protected $with = ['comments'];

    public function getHumanCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_id');
       
    }
}
