<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait HasCareerScope
{
    /**
     * Get CareerID for a query by role
     *
     * @return int|null
     *
     */

    public function getCareerIdForScope(): ?int
    {
        if ($this->hasRole('admin')) return null;

        if ($this->hasRole('gestor-teacher')) {
            return optional($this->teacherProfile)->career_id;
        }

        if ($this->hasRole('tutor')) {
            return optional($this->teacherProfile)->career_id;
        }

        if ($this->hasRole('student')) {

            if (!optional($this->profile)->userData) {
                abort(403, 'Tu perfil de estudiante está incompleto.');
            }

            return optional(optional($this->profile)->userData)->career_id;
        }

        return null;
    }

    /**
     * Filter Scope for a query by User's Career
     *
     * @param Builder $query
     * @param User $user
     * @return Builder
     */

    public function scopeByUserCareer(Builder $query, User $user)
    {
        $careerId = $user->getCareerIdForScope();

        if ($careerId) {
            return $query->where('career_id', $careerId);
        }

        return $query;
    }

    /**
     * Get all Receiving Entities associated with the authenticated user's career.
     *
     * This helper is used to retrieve only the entities (receiving centers) that
     * have an active relation with the career of the logged-in user. It applies to
     * students and assumes userData is present.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public static function byEntityCareer(User $user)
    {
        $careerId = $user->getCareerIdForScope();

        logger()->info($careerId);

        if (!$careerId) {
            return self::query();
        }

        return self::whereHas('careers', function ($q) use ($careerId) {
            $q->where('careers.id', $careerId);
        });
    }
}
