<?php

namespace App\Policies;

use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SocialMediaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Anda bisa mengizinkan semua user untuk melihat SocialMedia
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SocialMedia $socialMedia): bool
    {
        // Anda bisa mengizinkan semua user untuk melihat SocialMedia
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya superAdmin yang bisa membuat SocialMedia
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SocialMedia $socialMedia): bool
    {
        // Admin dan superAdmin bisa mengupdate SocialMedia
        return $user->hasRole('admin') || $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SocialMedia $socialMedia): bool
    {
        // Hanya superAdmin yang bisa menghapus SocialMedia
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SocialMedia $socialMedia): bool
    {
        // Hanya superAdmin yang bisa mengembalikan SocialMedia yang dihapus
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SocialMedia $socialMedia): bool
    {
        // Hanya superAdmin yang bisa menghapus SocialMedia secara permanen
        return $user->hasRole('superAdmin');
    }
}
