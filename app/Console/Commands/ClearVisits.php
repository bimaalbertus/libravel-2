<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class ClearVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:clear';

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
        Visitor::truncate();

        if (config('session.driver') === 'database') {
            DB::table('sessions')->truncate();
        }

        session()->flush();

        $this->info('All visits and sessions cleared.');
    }
}
