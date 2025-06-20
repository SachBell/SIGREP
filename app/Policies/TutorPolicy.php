<?php

namespace App\Policies;

use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TutorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TeacherProfile $teacherProfile): bool
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
    public function update(User $user, TeacherProfile $teacherProfile): bool
    {
        return $user->hasRole('admin') || $user->id === $teacherProfile->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TeacherProfile $teacherProfile): bool
    {
        return $user->hasRole('admin') && $user->id !== $teacherProfile->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TeacherProfile $teacherProfile): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TeacherProfile $teacherProfile): bool
    {
        //
    }
}
