<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // superAdmin dan admin dapat melihat daftar event
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        // superAdmin dapat melihat event mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat melihat event
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // superAdmin dan admin dapat membuat event
        return $user->hasRole('superAdmin') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        // superAdmin dapat mengubah event mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat mengubah event
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        // superAdmin dapat menghapus event mana saja
        if ($user->hasRole('superAdmin')) {
            return true;
        }

        // admin juga dapat menghapus event
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        // superAdmin dapat mengembalikan event mana saja
        return $user->hasRole('superAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        // superAdmin dapat menghapus permanen event mana saja
        return $user->hasRole('superAdmin');
    }
}
