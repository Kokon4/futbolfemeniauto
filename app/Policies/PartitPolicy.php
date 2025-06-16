<?php

namespace App\Policies;

use App\Models\Partit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PartitPolicy
{
   
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Partit $partit): bool
    {
        return $user->role === 'arbitre' && $user->id === $partit->arbitre_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Partit $partit): bool
    {
        return $user->role === 'administrador' || ($user->role === 'arbitre');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Partit $partit)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Partit $partit)
    {
        //
    }
}
