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
        $verifyStates = [];
        $snapshots = [];
        $events = [];
        $eventStates = [];
        for ($j = 0; $j < 1_000_000; $j++) {
            $snapshotId = snowflake_id();
            $verifyStates[$snapshotId] = '';
            for ($i = 0; $i < 5; $i++) {
                $eventId = snowflake_id();
                $events[] = [
                    'id' => $eventId,
                    'type' => 'App\Events\CustomerCountIterated',
                    'data' => '{"customer_id":'  . $snapshotId . '}',
                    'metadata' => '[]'
                ];

                $eventStates[] = [
                    'id' => snowflake_id(),
                    'event_id' => $eventId,
                    'state_id' => $snapshotId,
                    'state_type' => 'App\States\CustomerState',
                ];
            }

            $snapshots[] = [
                'id' => $snapshotId,
                'type' => 'App\States\CustomerState',
                'data' => '{"count":5}',
                'last_event_id' => $eventId,
            ];
            if ($j % 1_00 === 0) {
                $this->info($j);
                DB::beginTransaction();
                VerbSnapshot::query()->insert($snapshots);
                VerbEvent::query()->insert($events);
                VerbStateEvent::query()->insert($eventStates);
                DB::commit();
                $snapshots = [];
                $events = [];
                $eventStates = [];
            }
        }

    }
}
