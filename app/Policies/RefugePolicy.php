<?php

namespace App\Policies;

use App\Refuge;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RefugePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any refuges.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the refuge.
     *
     * @param  \App\User  $user
     * @param  \App\Refuge  $refuge
     * @return mixed
     */
    public function view(User $user, Refuge $refuge)
    {
        //
    }

    /**
     * Determine whether the user can create refuges.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id;
    }

    /**
     * Determine whether the user can update the refuge.
     *
     * @param  \App\User  $user
     * @param  \App\Refuge  $refuge
     * @return mixed
     */
    public function update(User $user, Refuge $refuge)
    {
        return $user->id === $refuge->user_id;
    }

    /**
     * Determine whether the user can delete the refuge.
     *
     * @param  \App\User  $user
     * @param  \App\Refuge  $refuge
     * @return mixed
     */
    public function delete(User $user, Refuge $refuge)
    {
        return $user->id === $refuge->user_id;
    }

    /**
     * Determine whether the user can restore the refuge.
     *
     * @param  \App\User  $user
     * @param  \App\Refuge  $refuge
     * @return mixed
     */
    public function restore(User $user, Refuge $refuge)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the refuge.
     *
     * @param  \App\User  $user
     * @param  \App\Refuge  $refuge
     * @return mixed
     */
    public function forceDelete(User $user, Refuge $refuge)
    {
        //
    }
}
