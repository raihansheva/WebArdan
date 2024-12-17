<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;

class SettingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Hanya superAdmin yang bisa CRUD, sedangkan admin hanya bisa melihat daftar setting
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Setting $setting): bool
    {
        // Hanya superAdmin yang bisa CRUD, admin hanya bisa melihat setting
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya superAdmin yang bisa membuat setting
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Setting $setting): bool
    {
        // Hanya superAdmin yang bisa mengupdate setting
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Setting $setting): bool
    {
        // Hanya superAdmin yang bisa menghapus setting
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Setting $setting): bool
    {
        // Hanya superAdmin yang bisa mengembalikan setting
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Setting $setting): bool
    {
        // Hanya superAdmin yang bisa menghapus permanen setting
        return $user->hasRole('superAdmin');
    }
}
