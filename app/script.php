<?php

require './../vendor/autoload.php';
$app = require_once '../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Number;

$time_start = microtime(true);
\DB::statement(
"select * from `verb_state_events` where `state_id` = 196875813868675074 and `state_type` = 'App\\States\\CustomerState' order by `id` asc limit 2"
);
$time_end = microtime(true);
$execution_time = ($time_end - $time_start) * 1000;

echo Number::format($execution_time, 0) . " ms";

