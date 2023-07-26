<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->check() ;

    }
    public function login(User $user): bool
    {
        dd('login post x');
         return auth()->check() ;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        // dd($post->user_id);1
        // dd(auth()->user()->id);53
       //   dd( auth()->check() && ($post->user_id==auth()->user()->id  || auth()->user()->is_admin) );
       return auth()->check() && ($post->user_id==auth()->user()->id || auth()->user()->is_admin) ;
 
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return auth()->check() && ($post->user_id==auth()->user()->id || auth()->user()->is_admin) ;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return auth()->check() && ($post->user_id==auth()->user()->id || auth()->user()->is_admin) ;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return auth()->check() && ($post->user_id==auth()->user()->id || auth()->user()->is_admin) ;


    }
}
