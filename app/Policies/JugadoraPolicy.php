<?php

namespace App\Policies;

use App\Models\Jugadora;
use App\Models\User;
use App\Models\Equip;
use Illuminate\Auth\Access\Response;

class JugadoraPolicy
{
 
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Jugadora $jugadora)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'manager';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Jugadora $jugadora): bool
    {
        return $user->role === 'manager' && $user->equip_id === $jugadora->equip_id;
    }

    public function delete(User $user, Jugadora $jugadora): bool
    {
        return $user->role === 'manager' && $user->equip_id === $jugadora->equip_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Jugadora $jugadora)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Jugadora $jugadora)
    {
        //
    }
}
