<?php

namespace App\Policies;

use App\User;
use App\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public $owner = ['author'];

    /**
     * Determine whether the user can view the video.
     *
     * @param  \App\User  $user
     * @param  \App\Video  $video
     * @return mixed
     */
    public function view(User $user, Video $video)
    {
        return true;
    }

    /**
     * Determine whether the user can create videos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole($this->owner);
    }

    /**
     * Determine whether the user can update the video.
     *
     * @param  \App\User  $user
     * @param  \App\Video  $video
     * @return mixed
     */
    public function update(User $user, Video $video)
    {   
        $owner = $user->id == $video->owner;

        if($owner || $user->hasRole(['editor'])){
           return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the video.
     *
     * @param  \App\User  $user
     * @param  \App\Video  $video
     * @return mixed
     */
    public function delete(User $user, Video $video)
    {
        return $user->id == $video->owner;
    }


    //admin for anything

    public function before($user, $ability)
        {
            if ($user->isSuperAdmin()) {
                return true;
            }
        }
}
