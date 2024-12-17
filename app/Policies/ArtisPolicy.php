<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Artis;

class ArtisPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat daftar artis
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Artis $artis): bool
    {
        // superAdmin dan admin dapat melihat artis tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat artis baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Artis $artis): bool
    {
        // superAdmin dan admin dapat mengupdate artis
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Artis $artis): bool
    {
        // superAdmin dan admin dapat menghapus artis
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Artis $artis): bool
    {
        // superAdmin dan admin dapat mengembalikan artis
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Artis $artis): bool
    {
        // superAdmin dan admin dapat menghapus artis secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
