<?php

namespace App\Policies;

use App\Models\Program;
use App\Models\User;

class ProgramPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat daftar program
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Program $program): bool
    {
        // superAdmin dapat melihat program mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat melihat program
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat program
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Program $program): bool
    {
        // superAdmin dapat mengubah program mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat mengubah program
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Program $program): bool
    {
        // superAdmin dapat menghapus program mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat menghapus program
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Program $program): bool
    {
        // superAdmin dapat mengembalikan program mana saja
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Program $program): bool
    {
        // superAdmin dapat menghapus permanen program mana saja
        return $user->hasRole('superAdmin');
    }
}
