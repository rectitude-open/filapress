<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use RectitudeOpen\FilamentBanManager\Models\Ban;

class BanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_any_ban');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ban $ban): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_ban');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('create_ban');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ban $ban): bool
    {
        return $user->hasRole('super-admin') || $user->can('update_ban');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ban $ban): bool
    {
        return $user->hasRole('super-admin') || $user->can('delete_ban');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ban $ban): bool
    {
        return $user->hasRole('super-admin') || $user->can('restore_ban');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ban $ban): bool
    {
        return $user->hasRole('super-admin') || $user->can('force_delete_ban');
    }
}
