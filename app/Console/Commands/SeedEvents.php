<?php

namespace App\Console\Commands;

use App\Events\CustomerBeganTrial;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Thunk\Verbs\Models\VerbEvent;
use Thunk\Verbs\Models\VerbSnapshot;
use Thunk\Verbs\Models\VerbStateEvent;

class SeedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $eventStates = [];
        for ($j = 0; $j < 1_000_000; $j++) {
            $snapshotId = snowflake_id();
            for ($i = 0; $i < 5; $i++) {
                $eventId = snowflake_id();
                $eventStates[] = [
                    'id' => snowflake_id(),
                    'event_id' => $eventId,
                    'state_id' => $snapshotId,
                    'state_type' => 'App\States\CustomerState',
                ];
            }

            if ($j % 1_000 === 0) {
                $this->info($j);
                DB::beginTransaction();
                VerbStateEvent::query()->insert($eventStates);
                DB::commit();
                $eventStates = [];
            }
        }

    }
}
