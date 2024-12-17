<?php

namespace App\Policies;

use App\Models\Chart;
use App\Models\User;

class ChartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat semua chart
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chart $chart): bool
    {
        // superAdmin dan admin dapat melihat chart tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat chart baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chart $chart): bool
    {
        // superAdmin dan admin dapat mengupdate chart
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chart $chart): bool
    {
        // superAdmin dan admin dapat menghapus chart
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chart $chart): bool
    {
        // superAdmin dan admin dapat mengembalikan chart
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chart $chart): bool
    {
        // superAdmin dan admin dapat menghapus chart secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
