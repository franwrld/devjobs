<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\Response;

class VacantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Ocultar el accesso a usuarios que buscan empleo rol=2 son reclutadores rol=1 los que buscan empleo
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vacante $vacante): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Ocultar el accesso a usuarios que buscan empleo a poder crear vacantes rol=2 son reclutadores rol=1 los que buscan empleo
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacante $vacante): bool
    {
        // Si el usuario autenticado es el mismo que creo la vacante
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vacante $vacante): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vacante $vacante): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vacante $vacante): bool
    {
        return false;
    }
}
