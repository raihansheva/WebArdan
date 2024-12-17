<?php

namespace App\Policies;

use App\Models\TagInfo;
use App\Models\User;

class TagInfoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin bisa mengakses semua model TagInfo
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TagInfo $tagInfo): bool
    {
        // superAdmin dan admin bisa melihat model TagInfo
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // hanya superAdmin yang bisa membuat TagInfo
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TagInfo $tagInfo): bool
    {
        // hanya superAdmin yang bisa memperbarui TagInfo
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TagInfo $tagInfo): bool
    {
        // hanya superAdmin yang bisa menghapus TagInfo
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TagInfo $tagInfo): bool
    {
        // hanya superAdmin yang bisa mengembalikan TagInfo
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TagInfo $tagInfo): bool
    {
        // hanya superAdmin yang bisa menghapus TagInfo secara permanen
        return $user->hasRole('superAdmin');
    }
}
