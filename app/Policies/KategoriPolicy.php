<?php

namespace App\Policies;

use App\Models\Kategori;
use App\Models\User;

class KategoriPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat semua model Kategori
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Kategori $kategori): bool
    {
        // superAdmin dan admin dapat melihat model Kategori
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // hanya superAdmin yang bisa membuat Kategori
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Kategori $kategori): bool
    {
        // hanya superAdmin yang bisa memperbarui Kategori
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Kategori $kategori): bool
    {
        // hanya superAdmin yang bisa menghapus Kategori
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Kategori $kategori): bool
    {
        // hanya superAdmin yang bisa mengembalikan Kategori
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Kategori $kategori): bool
    {
        // hanya superAdmin yang bisa menghapus Kategori secara permanen
        return $user->hasRole('superAdmin');
    }
}
