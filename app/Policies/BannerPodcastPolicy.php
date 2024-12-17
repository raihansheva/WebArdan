<?php

namespace App\Policies;

use App\Models\BannerPodcast;
use App\Models\User;

class BannerPodcastPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat semua banner podcast
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BannerPodcast $bannerPodcast): bool
    {
        // superAdmin dan admin dapat melihat banner podcast tertentu
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat banner podcast baru
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BannerPodcast $bannerPodcast): bool
    {
        // superAdmin dan admin dapat mengupdate banner podcast
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BannerPodcast $bannerPodcast): bool
    {
        // superAdmin dan admin dapat menghapus banner podcast
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BannerPodcast $bannerPodcast): bool
    {
        // superAdmin dan admin dapat mengembalikan banner podcast
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BannerPodcast $bannerPodcast): bool
    {
        // superAdmin dan admin dapat menghapus banner podcast secara permanen
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }
}
