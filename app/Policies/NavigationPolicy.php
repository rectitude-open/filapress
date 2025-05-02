<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Admin;
use App\Models\Navigation;

class NavigationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_navigation');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Navigation $navigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_navigation');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_navigation');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Navigation $navigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_navigation');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Navigation $navigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_navigation');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Navigation $navigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_navigation');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Navigation $navigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_navigation');
    }
}
