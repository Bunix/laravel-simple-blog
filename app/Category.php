<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = [
        'name',
    ];
    
    public function articles()
    {
        return $this->morphedByMany('App\Article', 'categoryable');
    }

    public function videos()
    {
        return $this->morphedByMany('App\Video', 'categoryable');
    }
}
