<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    protected $pageName='users';
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyForAdmin(User $user)
    {
       // dd($user);
        // return 7;
        // dd(11111);
        return $user->hasAbility('view-any-for-admin','admin.'.$this->pageName);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewForAdmin(User $user)
    {
        // return 666;
        return $user->hasAbility('view-for-admin','admin.'.$this->pageName);
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createForAdmin(User $user)
    {
        return $user->hasAbility('create-for-admin','admin.'.$this->pageName);
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateForAdmin(User $user)
    {
        return $user->hasAbility('update-for-admin','admin.'.$this->pageName);
        
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteForAdmin(User $user)
    {
        return $user->hasAbility('delete-for-admin','admin.'.$this->pageName);
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreForAdmin(User $user)
    {
        return $user->hasAbility('restore-for-admin','admin.'.$this->pageName);
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteForAdmin(User $user)
    {
        return $user->hasAbility('fore-delete-for-admin','admin.'.$this->pageName);
        
    }
}
