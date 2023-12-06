<?php

$lines = file($argv[1], FILE_IGNORE_NEW_LINES);
$times = trim(str_replace('Time:', '', $lines[0]));
$distances = trim(str_replace('Distance:', '', $lines[1]));
$times = explode(' ', preg_replace('/\s\s+/', ' ', $times));
$distances = explode(' ', preg_replace('/\s\s+/', ' ', $distances));

$total = 1;
foreach ($times as $k => $time) {
    $time = (int) $time;
    $possible = 0;
    for($hold = 1; $hold < $time; $hold++) {
        $travel = ($time - $hold) * $hold;
        if ($travel > (int) $distances[$k]) {
            $possible++;
        }
    }
    if ($possible > 0) {
        $total *= $possible;
    }
}
printf("total: %d\n", $total);
