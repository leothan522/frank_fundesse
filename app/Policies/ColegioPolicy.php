<?php

namespace App\Policies;

use App\Models\Colegio;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ColegioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Colegio $colegio): bool
    {
        return isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Colegio $colegio): bool
    {
        return isAdmin() && empty($colegio->deleted_at);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Colegio $colegio): bool
    {
        return isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Colegio $colegio): bool
    {
        return isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Colegio $colegio): bool
    {
        return $user->is_root;
    }
}
