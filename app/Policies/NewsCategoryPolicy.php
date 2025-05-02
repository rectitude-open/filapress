<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Admin;
use App\Models\NewsCategory;

class NewsCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_news_category');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, NewsCategory $newsCategory): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_news_category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_news_category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, NewsCategory $newsCategory): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_news_category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, NewsCategory $newsCategory): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_news_category');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, NewsCategory $newsCategory): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_news_category');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, NewsCategory $newsCategory): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_news_category');
    }
}
