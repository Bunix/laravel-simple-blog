<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    
    protected $fillable = [
        'body', 'comment_id', 'replier',
    ];

    public function comment(){
    	return $this->belongsTo('App\Comment');
    }

    public function user(){
        return $this->belongsTo('App\User','replier');
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
