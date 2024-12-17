<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Youtube;

class YoutubePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat daftar youtube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Youtube $youtube): bool
    {
        // superAdmin dan admin dapat melihat youtube tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat youtube baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Youtube $youtube): bool
    {
        // superAdmin dan admin dapat mengupdate youtube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Youtube $youtube): bool
    {
        // superAdmin dan admin dapat menghapus youtube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Youtube $youtube): bool
    {
        // superAdmin dan admin dapat mengembalikan youtube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Youtube $youtube): bool
    {
        // superAdmin dan admin dapat menghapus youtube secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
