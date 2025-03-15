<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearInactiveVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:clear-inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear visits that have been inactive for 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sessionLifetime = config('session.lifetime', 120);
        $cutoff = Carbon::now()->subMinutes($sessionLifetime);

        Visitor::where('visited_at', '<', $cutoff)->delete();

        if (config('session.driver') === 'database') {
            DB::table('sessions')->where('last_activity', '<', $cutoff->timestamp)->delete();
        }

        $this->info('Inactive visits cleared.');
    }
}
