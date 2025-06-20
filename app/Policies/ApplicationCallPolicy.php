<?php

namespace App\Policies;

use App\Models\ApplicationCall;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationCallPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'gestor-teacher', 'tutor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ApplicationCall $applicationCall): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'gestor-teacher']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ApplicationCall $applicationCall): bool
    {
        // dd(auth()->user()->getRoleNames());

        if ($user->hasRole('admin')) {
            return true;
        }

        return $user->hasRole('gestor-teacher') && $user->getCareerIdForScope() === $applicationCall->career_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ApplicationCall $applicationCall): bool
    {
        return $this->update($user, $applicationCall);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ApplicationCall $applicationCall): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ApplicationCall $applicationCall): bool
    {
        //
    }
}
