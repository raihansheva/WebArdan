<?php

namespace App\Policies;

use App\Models\Announcer;
use App\Models\User;

class AnnouncerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat semua announcer
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Announcer $announcer): bool
    {
        // superAdmin dan admin dapat melihat announcer tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat announcer baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Announcer $announcer): bool
    {
        // superAdmin dan admin dapat mengupdate announcer
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Announcer $announcer): bool
    {
        // superAdmin dan admin dapat menghapus announcer
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Announcer $announcer): bool
    {
        // superAdmin dan admin dapat mengembalikan announcer
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Announcer $announcer): bool
    {
        // superAdmin dan admin dapat menghapus announcer secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
