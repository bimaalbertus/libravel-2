<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\ClearInactiveVisits;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    User::where('delete_request_at', '<=', now()->subDays(30))->delete();
})->daily();

Schedule::command(ClearInactiveVisits::class)->daily();
