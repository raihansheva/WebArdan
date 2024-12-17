<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Podcast;

class PodcastPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat daftar podcast
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Podcast $podcast): bool
    {
        // superAdmin dapat melihat podcast mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga bisa melihat podcast
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat podcast
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Podcast $podcast): bool
    {
        // superAdmin dapat mengubah podcast mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin hanya dapat mengubah podcast tertentu (opsional, misalnya berdasarkan pembuatnya)
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Podcast $podcast): bool
    {
        // superAdmin dapat menghapus podcast mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat menghapus podcast
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Podcast $podcast): bool
    {
        // superAdmin dapat mengembalikan podcast mana saja
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Podcast $podcast): bool
    {
        // superAdmin dapat menghapus permanen podcast mana saja
        return $user->hasRole('superAdmin');
    }
}
