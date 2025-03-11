<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class TimeHelper
{
    public static function timeAgo($dateTime)
    {
        $now = Carbon::now();
        $diff = $now->diff($dateTime);

        if ($diff->y > 0) {
            return __('time.years_ago', ['count' => $diff->y]);
        } elseif ($diff->m > 0) {
            return __('time.months_ago', ['count' => $diff->m]);
        } elseif ($diff->d > 6) {
            $weeks = floor($diff->d / 7);
            return __('time.weeks_ago', ['count' => $weeks]);
        } elseif ($diff->d > 0) {
            return __('time.days_ago', ['count' => $diff->d]);
        } elseif ($diff->h > 0) {
            return __('time.hours_ago', ['count' => $diff->h]);
        } elseif ($diff->i > 0) {
            return __('time.minutes_ago', ['count' => $diff->m]);
        } else {
            return __('time.seconds_ago', ['count' => $diff->s]);
        }
    }
}
