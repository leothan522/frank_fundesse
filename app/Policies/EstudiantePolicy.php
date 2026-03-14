<?php

namespace App\Policies;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EstudiantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return isAdmin() || $user->colegios_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Estudiante $estudiante): bool
    {
        return isAdmin() || $user->colegios_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return isAdmin() || $user->colegios_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Estudiante $estudiante): bool
    {
        return (isAdmin() || $user->colegios_id) && empty($estudiante->deleted_at);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Estudiante $estudiante): bool
    {
        return isAdmin() || $user->colegios_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Estudiante $estudiante): bool
    {
        return isAdmin() || $user->colegios_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Estudiante $estudiante): bool
    {
        return $user->is_root;
    }
}
