<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
       // return false;
        //dd(66);
        return $user->hasAbility('products.view-any');
           
          
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\roduct  $roduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, roduct $roduct)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\roduct  $roduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, roduct $roduct)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\roduct  $roduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, roduct $roduct)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\roduct  $roduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, roduct $roduct)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\roduct  $roduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, roduct $roduct)
    {
        //
    }
}
