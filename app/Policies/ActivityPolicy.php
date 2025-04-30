<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class ActivityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_any_activity');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Activity $activity): bool
    {
        return $user->hasRole('super-admin') || $user->can('view_activity');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('create_activity');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Activity $activity): bool
    {
        return $user->hasRole('super-admin') || $user->can('update_activity');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Activity $activity): bool
    {
        return $user->hasRole('super-admin') || $user->can('delete_activity');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Activity $activity): bool
    {
        return $user->hasRole('super-admin') || $user->can('restore_activity');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Activity $activity): bool
    {
        return $user->hasRole('super-admin') || $user->can('force_delete_activity');
    }
}
