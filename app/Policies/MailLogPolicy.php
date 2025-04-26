<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Tapp\FilamentMailLog\Models\MailLog;

class MailLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_mail_logs');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MailLog $mailLog): bool
    {
        return $user->can('view_mail_log');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_mail_log');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MailLog $mailLog): bool
    {
        return $user->can('update_mail_log');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MailLog $mailLog): bool
    {
        return $user->can('delete_mail_log');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MailLog $mailLog): bool
    {
        return $user->can('restore_mail_log');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MailLog $mailLog): bool
    {
        return $user->can('force_delete_mail_log');
    }
}
