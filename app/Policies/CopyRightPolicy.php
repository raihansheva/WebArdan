<?php

namespace App\Policies;

use App\Models\CopyRight;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CopyRightPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Anda bisa mengizinkan semua user untuk melihat, bisa disesuaikan
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CopyRight $copyRight): bool
    {
        // Anda bisa mengizinkan semua user untuk melihat, bisa disesuaikan
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya superAdmin yang bisa membuat CopyRight
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CopyRight $copyRight): bool
    {
        // Admin dan superAdmin bisa mengupdate
        return $user->hasRole('admin') || $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CopyRight $copyRight): bool
    {
        // Hanya superAdmin yang bisa menghapus
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CopyRight $copyRight): bool
    {
        // Hanya superAdmin yang bisa mengembalikan data yang dihapus
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CopyRight $copyRight): bool
    {
        // Hanya superAdmin yang bisa menghapus secara permanen
        return $user->hasRole('superAdmin');
    }
}
