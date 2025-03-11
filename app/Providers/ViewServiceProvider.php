<?php

namespace App\Providers;

use App\Helpers\TimeHelper;
use App\Models\Major;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $joined = null;
            $userMajor = null;

            if ($user) {
                $joined = TimeHelper::timeAgo($user->created_at);
                $userMajor = $user->major;

                foreach (Major::all() as $major) {
                    if ($user->major == $major->abbreviation) {
                        $userMajor = $major->name;
                        break;
                    }
                }
            }

            $view->with(['user' => $user, 'joined' => $joined, 'userMajor' => $userMajor]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentNamespace('pages.account', 'account');
    }
}
