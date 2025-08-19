<?php

namespace App\Providers;

use App\Exceptions\NotDataException;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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

        View::composer([
            'Admin.settings.index',
            'partials.sidebar',
            'Admin.settings.partials.general'
        ], function ($view) {

            $updateInfo = $this->checkForUpdates();
            $currentVersion = config('app.version');

            $hasUpdate = $updateInfo['hasUpdate'];
            $latestVersion = $updateInfo['latestVersion'];
            $changelogUrl = $updateInfo['changelogUrl'];

            $view->with('hasUpdate', $hasUpdate);
            $view->with('changelogUrl', $changelogUrl);
            $view->with('latestVersion', $latestVersion);
            $view->with('currentVersion', $currentVersion);

            return $view;
        });

        Blade::component('admin.components.modal', 'admin-modal');
    }

    private function checkForUpdates()
    {

        return Cache::remember('latest_version_info', now()->addMinute(1), function () {
            $currentVersion = config('app.version');

            try {
                $response = Http::withToken(config('services.github.token'))
                    ->accept('application/vnd.github.v3+json')
                    ->get('https://api.github.com/repos/SachBell/SIGREP/releases/latest');

                if (!$response->ok()) {
                    throw new \Exception("GitHub API error");
                }

                $rawTag = $response->json('tag_name', 'v');
                $latestVersion = preg_replace('/[^0-9\.\-a-zA-Z]/', '', str_replace('SGPP-v', '', $rawTag));

                $changelogUrl = $response->json('html_url');

                return [
                    'hasUpdate' => version_compare($latestVersion, $currentVersion, '>'),
                    'latestVersion' => $latestVersion,
                    'changelogUrl' => $changelogUrl,
                    'currentVersion' => $currentVersion,
                ];
            } catch (\Throwable $e) {

                logger($e->getMessage());

                return [
                    'hasUpdate' => false,
                    'latestVersion' => $currentVersion,
                    'changelogUrl' => null,
                    'currentVersion' => $currentVersion,
                ];
            }
        });
    }
}
