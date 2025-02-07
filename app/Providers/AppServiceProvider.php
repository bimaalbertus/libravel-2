<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Extensions\DatabaseSessionHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        // Session::extend('database', function ($app) {
        //     $table   = config('session.table');
        //     $minutes = config('session.lifetime');

        //     return new DatabaseSessionHandler($this->getDatabaseConnection(), $table, $minutes, $app);
        // });
    }

    protected function getDatabaseConnection()
    {
        // $connection = config('session.connection');

        // return DB::connection($connection);
    }
}
