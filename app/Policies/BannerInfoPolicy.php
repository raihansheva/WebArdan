<?php

namespace App\Policies;

use App\Models\BannerInfo;
use App\Models\User;

class BannerInfoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat semua banner info
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BannerInfo $bannerInfo): bool
    {
        // superAdmin dan admin dapat melihat banner info tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat banner info baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BannerInfo $bannerInfo): bool
    {
        // superAdmin dan admin dapat mengupdate banner info
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BannerInfo $bannerInfo): bool
    {
        // superAdmin dan admin dapat menghapus banner info
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BannerInfo $bannerInfo): bool
    {
        // superAdmin dan admin dapat mengembalikan banner info
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BannerInfo $bannerInfo): bool
    {
        // superAdmin dan admin dapat menghapus banner info secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
