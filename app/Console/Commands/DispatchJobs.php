<?php

namespace App\Console\Commands;

use App\Jobs\ParallelJob;
use Illuminate\Console\Command;

class DispatchJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispatch-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
        ParallelJob::dispatch();
    }
}
