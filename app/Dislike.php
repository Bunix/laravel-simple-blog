<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    protected $fillable =[
    	'user_id','dislikeable_id','dislikeable_type',
    ];

    public function dislikeable()
    {
        return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
