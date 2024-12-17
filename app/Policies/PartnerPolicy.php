<?php

namespace App\Policies;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PartnerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Anda bisa mengizinkan semua user untuk melihat partner
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Partner $partner): bool
    {
        // Anda bisa mengizinkan semua user untuk melihat partner
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya superAdmin yang bisa membuat partner
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Partner $partner): bool
    {
        // Admin dan superAdmin bisa mengupdate partner
        return $user->hasRole('admin') || $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Partner $partner): bool
    {
        // Hanya superAdmin yang bisa menghapus partner
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Partner $partner): bool
    {
        // Hanya superAdmin yang bisa mengembalikan partner yang dihapus
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Partner $partner): bool
    {
        // Hanya superAdmin yang bisa menghapus partner secara permanen
        return $user->hasRole('superAdmin');
    }
}
