<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Closure;

class LivewireAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Livewire::componentHook(
            function ($instance, $currentComponent) {
                $middleware = function (Request $request, Closure $next) {
                    return app(Authenticate::class)->handle($request, $next, ['web']); // 'web' atau guard yang sesuai
                };

                app()->call($middleware);
            }
        );
    }
}
