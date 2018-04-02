<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    protected $fillable = [
        'title', 'slug', 'src','desc','owner',
    ];


    public function author(){
    	return $this->belongsTo('App\User','owner');
    }
    

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }


    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function categories()
    {
        return $this->morphToMany('App\Category', 'categoryable');
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
