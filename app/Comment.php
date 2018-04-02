<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected $fillable = [
        'body', 'commentable_id', 'commentable_type','commenter',
    ];


    public function commentable()
    {
        return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo('App\User','commenter');
    }

    public function replies(){
    	return $this->hasMany('App\Reply');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function dislikes()
    {
        return $this->morphMany('App\Dislike', 'dislikeable');
    }
}
