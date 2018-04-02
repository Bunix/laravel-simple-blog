<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function comments(){
        return $this->hasMany('App\Comment','commenter');
    }

    public function replies(){
        return $this->hasMany('App\Reply','replier');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function dislikes(){
        return $this->hasMany('App\Dislike');
    }

    public function article(){
        return $this->hasMany('App\Article','owner');
    }

    public function video(){
        return $this->hasMany('App\Video','owner');
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function hasAccess(array $permissions):bool{

        foreach($this->roles as $role){
           
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function hasRole(array $roles):bool{
       foreach ($roles as $role) {
        
         if($this->inRole($role)){
                return true;
            }
       }
       return false;
    }

    public function isSuperAdmin(){
        return $this->inRole('superAdmin');
    }

    public function inRole(String $role){

        return $this->roles()->where('name',$role)->count() == 1;
    }

}
