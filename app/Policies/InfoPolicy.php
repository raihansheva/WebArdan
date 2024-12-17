<?php

namespace App\Policies;

use App\Models\Info;
use App\Models\User;

class InfoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat daftar info
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Info $info): bool
    {
        // superAdmin dapat melihat info mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat melihat info
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat info
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Info $info): bool
    {
        // superAdmin dapat mengubah info mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat mengubah info
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Info $info): bool
    {
        // superAdmin dapat menghapus info mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat menghapus info
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Info $info): bool
    {
        // superAdmin dapat mengembalikan info mana saja
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Info $info): bool
    {
        // superAdmin dapat menghapus permanen info mana saja
        return $user->hasRole('superAdmin');
    }
}
