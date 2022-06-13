<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Post;


class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
   
    //users deletes only their posts
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

      //users edits only their posts
      public function edit(User $user, Post $post)
      {
          return $user->id === $post->user_id;
      }

}
