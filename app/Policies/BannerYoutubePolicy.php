<?php

namespace App\Policies;

use App\Models\BannerYoutube;
use App\Models\User;

class BannerYoutubePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat semua banner YouTube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BannerYoutube $bannerYoutube): bool
    {
        // superAdmin dan admin dapat melihat banner YouTube tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat banner YouTube baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BannerYoutube $bannerYoutube): bool
    {
        // superAdmin dan admin dapat mengupdate banner YouTube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BannerYoutube $bannerYoutube): bool
    {
        // superAdmin dan admin dapat menghapus banner YouTube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BannerYoutube $bannerYoutube): bool
    {
        // superAdmin dan admin dapat mengembalikan banner YouTube
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BannerYoutube $bannerYoutube): bool
    {
        // superAdmin dan admin dapat menghapus banner YouTube secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
