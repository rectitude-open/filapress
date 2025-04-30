<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use TomatoPHP\FilamentMediaManager\Models\Folder;

class FolderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_any_folder');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Folder $folder): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_folder');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('create_folder');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Folder $folder): bool
    {
        return $user->hasRole('super-admin') || $user->can('update_folder');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Folder $folder): bool
    {
        return $user->hasRole('super-admin') || $user->can('delete_folder');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Folder $folder): bool
    {
        return $user->hasRole('super-admin') || $user->can('restore_folder');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Folder $folder): bool
    {
        return $user->hasRole('super-admin') || $user->can('force_delete_folder');
    }
}
