<?php

$lines = file($argv[1]);
$total = 0;
foreach ($lines as $line) {
    preg_match('/Game (\d+): /', $line, $matches);
    $game = (int) $matches[1];
    $line = str_replace($matches[0], '', $line);
    $sets = explode(';', $line);
    $colors = [
        'red' => 0,
        'green' => 0,
        'blue' => 0,
    ];
    foreach ($sets as $set) {
        $cubes = explode(',', $set);
        foreach ($cubes as $cube) {
            preg_match('/(\d+)(.*)/', $cube, $matches);
            $count = (int) $matches[1];
            $color = trim($matches[2]);
            if ($colors[$color] < $count) {
                $colors[$color] = $count;
            }
        }
    }
    $power = $colors['red'] * $colors['green'] * $colors['blue'];
    $total += $power;
}

echo $total . "\n";