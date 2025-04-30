<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use TomatoPHP\FilamentMediaManager\Models\Media;

class MediaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_any_media');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_media');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('create_media');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin') || $user->can('update_media');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin') || $user->can('delete_media');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin') || $user->can('restore_media');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin') || $user->can('force_delete_media');
    }
}
