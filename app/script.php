<?php

require './../vendor/autoload.php';
$app = require_once '../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Number;

\Illuminate\Support\Facades\DB::enableQueryLog();


$time_start = microtime(true);
\DB::statement(
"select * from `verb_state_events` where `state_id` = 196875813868675074 and `state_type` = 'App\\States\\CustomerState' order by `id` asc limit 2"
);
$time_end = microtime(true);
$execution_time = ($time_end - $time_start) * 1000;

echo 'Broken query: ' . Number::format($execution_time, 0) . " ms\n";


$time_start = microtime(true);
\DB::statement(
    "select * from `verb_state_events` where `state_id` = 196875813868675074 and `state_type` = 'App\\States\\CustomerState' order by `id` limit 2"
);
$time_end = microtime(true);
$execution_time = ($time_end - $time_start) * 1000;

echo 'Fast query: ' . Number::format($execution_time, 0) . " ms\n";



// This one is fast on older versions of singlestore (8.5.5), but slow on the latest 8.7.3
$time_start = microtime(true);
\DB::statement(
    "select * from `verb_state_events` where `state_id` = 196875813868675074 and `state_type` = 'App\\States\\CustomerState' order by id asc limit 2"
);
$time_end = microtime(true);
$execution_time = ($time_end - $time_start) * 1000;

echo 'Fast on 8.5.5, slow on 8.7.3 query: ' . Number::format($execution_time, 0) . " ms\n\n";


$data = \Illuminate\Support\Facades\DB::getRawQueryLog();

foreach ($data as $item) {
    echo $item['raw_query'] . PHP_EOL;
    echo $item['time'] . PHP_EOL;
}
