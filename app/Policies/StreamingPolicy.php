<?php

namespace App\Policies;

use App\Models\Streaming;
use App\Models\User;

class StreamingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat semua streaming
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Streaming $streaming): bool
    {
        // superAdmin dan admin dapat melihat streaming tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat streaming baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Streaming $streaming): bool
    {
        // superAdmin dan admin dapat mengupdate streaming
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Streaming $streaming): bool
    {
        // superAdmin dan admin dapat menghapus streaming
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Streaming $streaming): bool
    {
        // superAdmin dan admin dapat mengembalikan streaming
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Streaming $streaming): bool
    {
        // superAdmin dan admin dapat menghapus streaming secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
