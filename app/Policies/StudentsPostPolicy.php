<?php

namespace App\Policies;

use App\Models\ApplicationDetail;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentsPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'gestor-teacher']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ApplicationDetail $applicationDetails): bool
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
    public function update(User $user, ApplicationDetail $applicationDetails): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return $user->hasRole('gestor-teacher') && $user->getCareerIdForScope() === $applicationDetails->applicationCalls->career_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ApplicationDetail $applicationDetails): bool
    {
        return $this->update($user, $applicationDetails);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ApplicationDetail $applicationDetails): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ApplicationDetail $applicationDetails): bool
    {
        //
    }
}
