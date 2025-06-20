<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\ApplicationCall;
use App\Models\ApplicationDetail;
use App\Models\Career;
use App\Models\ReceivingEntity;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Policies\ApplicationCallPolicy;
use App\Policies\CareerPolicy;
use App\Policies\ReceivingEntityPolicy;
use App\Policies\StudentsPostPolicy;
use App\Policies\TutorPolicy;
use App\Policies\UsersPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ApplicationCall::class => ApplicationCallPolicy::class,
        Career::class => CareerPolicy::class,
        User::class => UsersPolicy::class,
        ApplicationDetail::class => StudentsPostPolicy::class,
        ReceivingEntity::class => ReceivingEntityPolicy::class,
        TeacherProfile::class => TutorPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
