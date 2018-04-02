<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\permission');
    }

    public function hasAccess(array $permissions):bool{
        foreach($permissions as $permission){
            
            if($this->hasPermission($permission)){
                return true;
              }
              return false;
            }
        }
    
    private function hasPermission(String $permission):bool{
       
        return $this->permissions->contains('name',$permission);
    }
}
