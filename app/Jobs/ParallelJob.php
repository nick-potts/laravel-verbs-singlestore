<?php

namespace App\Jobs;

use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Number;

class ParallelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $time_start = microtime(true);
        DB::statement(
            "select * from `verb_state_events` where `state_id` = 196875813868675074 and `state_type` = 'App\\States\\CustomerState' order by `id` asc limit 2"
        );
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start) * 1000;

        echo "Broken query: " . Number::format($execution_time, 0) . " ms\n";
    }
}
