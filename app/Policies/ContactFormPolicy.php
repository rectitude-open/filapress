<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ContactForm;
use App\Models\User;

class ContactFormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_contact_form');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactForm $contactForm): bool
    {
        return $user->can('view_contact_form');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_contact_form');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContactForm $contactForm): bool
    {
        return $user->can('update_contact_form');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactForm $contactForm): bool
    {
        return $user->can('delete_contact_form');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ContactForm $contactForm): bool
    {
        return $user->can('restore_contact_form');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ContactForm $contactForm): bool
    {
        return $user->can('force_delete_contact_form');
    }
}
