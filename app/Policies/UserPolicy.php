<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dapat melakukan apa saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin hanya bisa melihat daftar user
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // superAdmin dapat melihat detail user mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin hanya bisa melihat user dengan role tertentu (opsional, contoh di bawah)
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dapat membuat user mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin hanya bisa membuat user tertentu (opsional, modifikasi sesuai kebutuhan)
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // superAdmin dapat mengubah user mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        if ($user->id == $model->id && $user->hasRole('admin')) {
            return true;
        }else{
            return false;
        }
        // admin hanya bisa mengubah user tertentu (misalnya, user dengan role tertentu atau miliknya sendiri)
        // return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // superAdmin dapat menghapus user mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin tidak diizinkan menghapus user (ubah sesuai kebutuhan)
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // superAdmin dapat mengembalikan user mana saja
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // superAdmin dapat menghapus permanen user mana saja
        return $user->hasRole('superAdmin');
    }
}
