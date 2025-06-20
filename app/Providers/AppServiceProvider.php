<?php

namespace App\Providers;

use App\Exceptions\NotDataException;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('student.*', function ($view) {

            $user = auth()->user();

            // dd($user->hasRole('student'));

            if (!$user) {
                return;
            }

            if ($user->getCareerIdForScope()) {
                return;
            }

            
            $tutor = $user->profile->userData->tutor ?? null;

            $isDual = $user->profile && $user->profile->userData?->careers && $user->profile->userData->careers->is_dual;

            $view->with([
                'isDual' => $isDual,
                'tutor' => $tutor
            ]);
            return $view;
        });

        View::composer('Admin.*', function ($view) {
            $user = auth()->user();

            // dd($user->hasRole('student'));

            if (!$user) {
                return;
            }

            $isDual = $user->profile && $user->profile->userData?->careers && $user->profile->userData->careers->is_dual;

            $view->with('isDual', $isDual);
            return $view;
        });

        Blade::component('admin.components.modal', 'admin-modal');
    }
}
